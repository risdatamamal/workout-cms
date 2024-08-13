<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class MemberPlanController extends Controller
{
    public function index()
    {
        return view('pages.member-plan.index');
    }

    public function getMemberPlanList(Request $request)
    {
        $data  = MemberPlan::get();

        return DataTables::of($data)
            ->addColumn('price_monthly', function ($data) {
                return 'Rp ' . number_format($data->price_monthly, 0, ',', '.');
            })
            ->addColumn('duration', function ($data) {
                if ($data->duration > 1) {
                    return $data->duration . ' Months';
                } else {
                    return $data->duration . ' Month';
                }
            })

            ->addColumn('status', function ($data) {
                $planActive = $data->is_active;
                $badges = '';
                if ($planActive == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('member-plan/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('member-plan/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['price_monthly', 'duration', 'status', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            return view('pages.member-plan.create');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required | string ',
            'description' => 'required | string ',
            'price_monthly'       => 'required | numeric',
            'duration'    => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        try {
            $memberPlan = MemberPlan::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'price_monthly' => $request->price_monthly,
                'duration'      => $request->duration,
                'is_active'     => $request->is_active
            ]);

            if ($memberPlan) {
                return redirect('member-plan')->with('success', 'New member plan created!');
            } else {
                return redirect()->back()->with('error', 'Failed to create new member plan! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $memberPlan = MemberPlan::find($id);

            if ($memberPlan) {
                return view('pages.member-plan.edit', compact('memberPlan'));
            } else {
                return redirect('member-plan')->with('error', 'Member Plan not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'           => 'required',
            'name'         => 'required | string ',
            'description'  => 'required | string ',
            'price_monthly' => 'required | numeric',
            'duration'     => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $memberPlan = MemberPlan::find($request->id);

            $memberPlan->update([
                'name'          => $request->name,
                'description'   => $request->description,
                'price_monthly' => $request->price_monthly,
                'duration'      => $request->duration,
                'is_active'     => $request->is_active
            ]);

            if ($memberPlan) {
                return redirect('member-plan')->with('success', 'Member plan information updated succesfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update member plan information! Try again.');
            }

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($id)
    {
        try {
            $memberPlan = MemberPlan::find($id);

            if ($memberPlan) {
                $memberPlan->delete();
                return redirect('member-plan')->with('success', 'Member Plan removed!');
            } else {
                return redirect('member-plan')->with('error', 'Member Plan not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
