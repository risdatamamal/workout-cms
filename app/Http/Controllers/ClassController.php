<?php

namespace App\Http\Controllers;

use App\Models\WorkoutClass;
use App\Models\User;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables, Auth;

class ClassController extends Controller
{
    public function index()
    {
        return view('pages.class.index');
    }

    public function getClassList(Request $request)
    {
        $data = WorkoutClass::get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('class/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('class/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $trainers = User::whereHas('roles', function ($query) {
                $query->where('name', 'Trainer');
            })->get();

            return view('pages.class.create', compact('trainers'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $class = WorkoutClass::find($id);

            if ($class) {
                $trainers = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Trainer');
                })->get();

                return view('pages.class.edit', compact('trainers', 'class'));
            } else {
                return redirect('admin')->with('error', 'Class not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
