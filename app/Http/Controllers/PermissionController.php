<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DataTables, Auth;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the roles page
     *
     */
    public function index()
    {
        try {
            $roles = Role::pluck('name', 'id');

            return view('pages.permissions.index', compact('roles'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     */

    public function getPermissionList(Request $request)
    {

        $data  = Permission::get();

        return Datatables::of($data)
            ->addColumn('roles', function ($data) {
                $roles = $data->roles()->get();
                $badges = '';
                foreach ($roles as $key => $role) {
                    if ($role->name == 'Admin') {
                        $badges .= '<span class="badge badge-success m-1">' . $role->name . '</span>';
                    } else if ($role->name == 'Trainer') {
                        $badges .= '<span class="badge badge-primary m-1">' . $role->name . '</span>';
                    } else {
                        $badges .= '<span class="badge badge-secondary m-1">' . $role->name . '</span>';
                    }
                }
                // if ($data->name == 'manage_role' || $data->name == 'manage_permission') {
                //     return '<span class="badge badge-success m-1">Admin</span>';
                // }

                return $badges;
            })
            ->addColumn('action', function ($data) {

                if (Auth::user()->can('manage_permission')) {
                    return '<div class="table-actions">
                                    <a href="' . url('permission/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     */

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            $permission = Permission::create(['name' => $request->permission]);
            $permission->syncRoles($request->roles);

            if ($permission) {
                return redirect('permission')->with('success', 'Permission created succesfully!');
            } else {
                return redirect('permission')->with('error', 'Failed to create permission! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    public function update(Request $request)
    {

        // update permission table
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->save();

        return $permission;
    }


    public function delete($id)
    {
        $permission   = Permission::find($id);
        if ($permission) {
            $delete = $permission->delete();
            $perm   = $permission->roles()->delete();

            return redirect('permission')->with('success', 'Permission deleted!');
        } else {
            return redirect('404');
        }
    }


    public function getPermissionBadgeByRole(Request $request)
    {
        $badges = '';
        if ($request->id) {
            $role = Role::find($request->id);
            $permissions =  $role->permissions()->pluck('name', 'id');

            foreach ($permissions as $key => $permission) {
                if ($permission == 'manage_user') {
                    $badges .= '<span class="badge badge-warning m-1">User Manage</span>';
                } elseif ($permission == 'manage_role') {
                    $badges .= '<span class="badge badge-success m-1">Role Manage</span>';
                } elseif ($permission == 'manage_permission') {
                    $badges .= '<span class="badge badge-success m-1">Permission Manage</span>';
                } elseif ($permission == 'manage_trainer') {
                    $badges .= '<span class="badge badge-secondary m-1">Trainer Manage</span>';
                } elseif ($permission == 'manage_customer') {
                    $badges .= '<span class="badge badge-secondary m-1">Customer Manage</span>';
                } else {
                    $badges .= '<span class="badge badge-secondary m-1">' . $permission . '</span>';
                }
            }
        } else {
            $badges .= '<span class="badge text-red m-1">Select role first</span>';
        }

        return $badges;
    }
}
