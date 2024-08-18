<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
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
        $data = WorkoutClass::with('trainer', 'speciality')->get();

        return DataTables::of($data)
            ->addColumn('class_name', function ($data) {
                return $data->speciality->name;
            })
            ->addColumn('trainer_name', function ($data) {
                return $data->trainer->user->name;
            })
            ->addColumn('level', function ($data) {
                if ($data->level == 'easy') {
                    return 'Easy';
                } elseif ($data->level == 'medium') {
                    return 'Medium';
                } elseif ($data->level == 'advanced') {
                    return 'Advanced';
                }
            })
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
            ->rawColumns(['class_name', 'trainer_name', 'level', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $trainers = Trainer::with('user')->get();

            $specialites = Speciality::get();

            return view('pages.class.create', compact('specialites', 'trainers'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'speciality_id' => 'required',
            'trainer_id' => 'required',
            'duration' => 'required | string',
            'capacity' => 'required | integer',
            'level' => 'required | string | in:easy,medium,advanced',
            'type' => 'required | string',
            'calories_burn' => 'required | integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $class = WorkoutClass::create([
                'speciality_id' => $request->speciality_id,
                'trainer_id' => $request->trainer_id,
                'duration' => $request->duration,
                'capacity' => $request->capacity,
                'level' => $request->level,
                'type' => $request->type,
                'calories_burn' => $request->calories_burn,
            ]);

            if ($class) {
                return redirect('class')->with('success', 'Class created successfully');
            } else {
                return redirect('class')->with('error', 'Class failed to create');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
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
                $users = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Trainer');
                })->get();

                return view('pages.class.edit', compact('users', 'class'));
            } else {
                return redirect('admin')->with('error', 'Class not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
