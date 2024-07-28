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

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users.index');
    }

    public function getUserList(Request $request)
    {

        $data  = User::get();

        return DataTables::of($data)
            ->addColumn('roles', function ($data) {
                $roles = $data->getRoleNames()->toArray();
                $badge = '';
                if ($roles) {
                    $badge = implode(' , ', $roles);
                }

                return $badge;
            })
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
            ->addColumn('action', function ($data) {
                if ($data->name == 'Admin') {
                    return '';
                }
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('user/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('user/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['roles', 'permissions', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $provinces = Province::all();
            $roles     = Role::pluck('name', 'id');
            return view('pages.users.create', compact('roles', 'provinces'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function getRegencies($provinceId)
    {
        $regencies = Regency::where('province_id', $provinceId)->get();
        return $regencies;
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
                return redirect('users')->with('success', 'New user created!');
            } else {
                return redirect('users')->with('error', 'Failed to create new user! Try again.');
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
                $roles     = Role::pluck('name', 'id');

                return view('pages.users.edit', compact('user', 'user_role', 'provinces', 'roles'));
            } else {
                return redirect('404');
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

            return redirect()->back()->with('success', 'User information updated succesfully!');
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
            return redirect('users')->with('success', 'User removed!');
        } else {
            return redirect('users')->with('error', 'User not found');
        }
    }
}
