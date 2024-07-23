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
            ->addColumn('membership', function ($data) {
                $user = $data->is_active;
                $badges = '';
                if ($user == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
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
                if (Auth::user()->id == $data->id) {
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
            ->rawColumns(['membership', 'permissions', 'action'])
            ->make(true);
    }
}
