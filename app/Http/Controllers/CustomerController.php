<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.customer.index');
    }

    public function getCustomerList(Request $request)
    {
        $data  = User::whereHas('roles', function ($query) {
            $query->where('name', 'Customer');
        })->get();

        return DataTables::of($data)
            ->addColumn('status', function ($data) {
                $user = $data->is_active;
                $badges = '';

                if ($user == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('membership', function ($data) {
                $customer = Member::where('user_id', $data->id)->first();
                $badges = '';

                if ($customer->member_plan_id == 1) {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                } else {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->id == $data->id) {
                    return '';
                }
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('customer/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('customer/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['status', 'membership', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $provinces = Province::all();
            $roles     = Role::where('name', 'Customer')->pluck('name', 'id');

            return view('pages.customer.create', compact('roles', 'provinces'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required | string ',
            'email'          => 'required | email | unique:users',
            'phone_number'   => 'required | string',
            'password'       => 'required | confirmed',
            'role'           => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone_number'  => $request->phone_number,
                'password'      => Hash::make($request->password),
                'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id,
                'is_active'     => $request->is_active
            ]);

            $user->syncRoles($request->role);

            $customer = Member::create([
                'user_id' => $user->id,
                'member_plan_id' => 1
            ]);

            if ($user && $customer) {
                return redirect('customer')->with('success', 'New customer created!');
            } else {
                return redirect()->back()->with('error', 'Failed to create new customer! Try again.');
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
            $customer = Member::where('user_id', $id)->first();

            if ($user && $customer) {
                $user_role = $user->roles->first();
                $provinces = Province::all();
                $roles     = Role::where('name', 'Customer')->pluck('name', 'id');

                return view('pages.customer.edit', compact('user', 'user_role', 'provinces', 'roles'));
            } else {
                return redirect('customer')->with('error', 'Customer not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'             => 'required',
            'name'           => 'required | string ',
            'email'          => 'required | email',
            'phone_number'   => 'required | string',
            'role'           => 'required'
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
                'phone_number'  => $request->phone_number,
                'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id,
                'is_active'     => $request->is_active
            ]);

            if (isset($request->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $user->syncRoles($request->role);

            return redirect('customer')->with('success', 'Customer information updated succesfully!');
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
            return redirect('customer')->with('success', 'Customer removed!');
        } else {
            return redirect('customer')->with('error', 'Customer not found');
        }
    }
}
