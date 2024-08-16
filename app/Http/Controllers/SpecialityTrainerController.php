<?php

namespace App\Http\Controllers;

use App\Models\CertificationTrainer;
use App\Models\ExperienceTrainer;
use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Speciality;
use App\Models\SpecialityTrainer;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class SpecialityTrainerController extends Controller
{
    public function index($trainer_id)
    {
        $trainer = Trainer::findOrFail($trainer_id);
        return view('pages.trainer.speciality.index', compact('trainer'));
    }

    public function getSpecialityTrainerList(Request $request, $trainer_id)
    {
        $data = SpecialityTrainer::where('trainer_id', $trainer_id)->get();

        return DataTables::of($data)
            ->addColumn('speciality', function ($data) {
                return $data->speciality->name;
            })
            ->addColumn('action', function ($data) {
                return '<div class="table-actions">
                            <a href="' . route('speciality-trainer.delete', ['trainer_id' => $data->trainer->id, 'id' => $data->id]) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
            })
            ->rawColumns(['speciality', 'action'])
            ->make(true);
    }

    public function create($trainer_id)
    {
        try {
            $specialities = Speciality::pluck('name', 'id');
            return view('pages.trainer.speciality.create', compact('trainer_id', 'specialities'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request, $trainer_id)
    {
        $validator = Validator::make($request->all(), [
            'speciality_id' => 'required | integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $existingSpecialityTrainer = SpecialityTrainer::where('trainer_id', $trainer_id)
                ->where('speciality_id', $request->speciality_id)
                ->first();

            if ($existingSpecialityTrainer) {
                return redirect()->back()->with('error', 'Speciality Trainer already exists for this trainer');
            } else {
                $specialityTrainer = SpecialityTrainer::create([
                    'trainer_id' => $trainer_id,
                    'speciality_id' => $request->speciality_id,
                ]);

                if ($specialityTrainer) {
                    return redirect()->route('speciality-trainer.index', $trainer_id)->with('success', 'Add Speciality Trainer successfully');
                } else {
                    return redirect()->route('speciality-trainer.index', $trainer_id)->with('error', 'Add Speciality Trainer failed');
                }
            }

        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($trainer_id, $id)
    {
        try {
            $specialityTrainer = SpecialityTrainer::findOrFail($id);

            if ($specialityTrainer) {
                $specialityTrainer->delete();
                return redirect()->route('speciality-trainer.index', $trainer_id)->with('success', 'Delete Speciality Trainer successfully');
            } else {
                return redirect()->route('speciality-trainer.index', $trainer_id)->with('error', 'Delete Speciality Trainer failed');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
