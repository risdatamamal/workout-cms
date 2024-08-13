<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use DataTables, Auth;
use Illuminate\Support\Facades\Validator;

class SpecialityController extends Controller
{
    public function index()
    {
        return view('pages.speciality.index');
    }

    public function getSpecialityList(Request $request)
    {
        $data = Speciality::all();

        return DataTables::of($data)
            ->addColumn('status', function ($data) {
                $status = $data->is_active;
                $badges = '';
                if ($status == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                return '<div class="table-actions">
                            <a href="' . url('speciality/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                            <a href="' . url('speciality/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            return view('pages.speciality.create');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required | string ',
            'is_active'      => 'required | integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $speciality = Speciality::create([
                'name'      => $request->name,
                'is_active' => $request->is_active,
            ]);

            if ($speciality) {
                return redirect('speciality')->with('success', 'Speciality created successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create speciality');
            }

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $data = Speciality::find($id);

            return view('pages.speciality.edit', compact('data'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required | string ',
            'is_active'      => 'required | integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $speciality = Speciality::find($request->id);

            $speciality->update([
                'name'      => $request->name,
                'is_active' => $request->is_active,
            ]);

            if ($speciality) {
                return redirect('speciality')->with('success', 'Speciality updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update speciality');
            }

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($id)
    {
        try {
            $speciality = Speciality::find($id);

            if ($speciality) {
                $speciality->delete();
                return redirect('speciality')->with('success', 'Speciality deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete speciality');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
