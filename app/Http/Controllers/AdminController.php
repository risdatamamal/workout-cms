<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
    }

    public function getAdminList(Request $request)
    {
        $data  = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        return DataTables::of($data)
            ->addColumn('permissions', function ($data) {
                $roles = $data->getAllPermissions();
                $badges = '';
                foreach ($roles as $key => $role) {
                    if ($role->name == 'manage_user') {
                        $badges .= '<span class="badge badge-warning m-1">User Manage</span>';
                    } elseif ($role->name == 'manage_role') {
                        $badges .= '<span class="badge badge-success m-1">Role Manage</span>';
                    } elseif ($role->name == 'manage_permission') {
                        $badges .= '<span class="badge badge-success m-1">Permission Manage</span>';
                    } elseif ($role->name == 'manage_trainer') {
                        $badges .= '<span class="badge badge-primary m-1">Trainer Manage</span>';
                    } else {
                        $badges .= '<span class="badge badge-secondary m-1">Customer Manage</span>';
                    }
                }

                return $badges;
            })
            ->addColumn('status', function ($data) {
                $userActive = $data->is_active;
                $badges = '';
                if ($userActive == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->id != $data->id) {
                    return '';
                }
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('admin/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('admin/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['permissions', 'status', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $provinces = Province::all();
            $roles     = Role::where('name', 'Admin')->pluck('name', 'id');

            return view('pages.admin.create', compact('roles', 'provinces'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required | string ',
            'email'    => 'required | email | unique:users',
            'password' => 'required | confirmed',
            'role'     => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id
            ]);

            $user->syncRoles($request->role);

            if ($user) {
                return redirect('admin')->with('success', 'New admin created!');
            } else {
                return redirect()->back()->with('error', 'Failed to create new admin! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $user  = User::with('roles', 'permissions')->find($id);

            if ($user) {
                $user_role = $user->roles->first();
                $provinces = Province::all();
                $roles     = Role::where('name', 'Admin')->pluck('name', 'id');

                return view('pages.admin.edit', compact('user', 'user_role', 'provinces', 'roles'));
            } else {
                return redirect('admin')->with('error', 'Admin not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'       => 'required',
            'name'     => 'required | string ',
            'email'    => 'required | email',
            'role'     => 'required'
        ]);

        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $user = User::find($request->id);

            $user->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id
            ]);

            if (isset($request->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $user->syncRoles($request->role);

            return redirect('admin')->with('success', 'Admin information updated succesfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect('admin')->with('success', 'Admin removed!');
        } else {
            return redirect('admin')->with('error', 'Admin not found');
        }
    }
}
