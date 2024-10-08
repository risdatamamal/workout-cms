<?php

namespace App\Http\Controllers;

use App\Models\CertificationTrainer;
use App\Models\ExperienceTrainer;
use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use App\Models\SpecialityTrainer;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class ExperienceTrainerController extends Controller
{
    public function index($trainer_id)
    {
        $trainer = Trainer::findOrFail($trainer_id);
        return view('pages.trainer.experience.index', compact('trainer'));
    }

    public function getExperienceTrainerList(Request $request, $trainer_id)
    {
        $data = ExperienceTrainer::where('trainer_id', $trainer_id)->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<div class="table-actions">
                            <a href="' . route('experience-trainer.delete', ['trainer_id' => $data->trainer->id, 'id' => $data->id]) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($trainer_id)
    {
        try {
            return view('pages.trainer.experience.create', compact('trainer_id'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request, $trainer_id)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required | string',
            'company' => 'required | string',
            'position' => 'required | string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $experienceTrainer = ExperienceTrainer::create([
                'trainer_id' => $trainer_id,
                'year' => $request->year,
                'company' => $request->company,
                'position' => $request->position,
            ]);

            if ($experienceTrainer) {
                return redirect()->route('experience-trainer.index', ['trainer_id' => $trainer_id])->with('success', 'Experience Trainer created successfully');
            } else {
                return redirect()->route('experience-trainer.index', ['trainer_id' => $trainer_id])->with('error', 'Experience Trainer failed to create');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($trainer_id, $id)
    {
        try {
            $experienceTrainer = ExperienceTrainer::where('trainer_id', $trainer_id)->findOrFail($id);

            if ($experienceTrainer) {
                $experienceTrainer->delete();
                return redirect()->route('experience-trainer.index', ['trainer_id' => $trainer_id])->with('success', 'Experience Trainer deleted successfully');
            } else {
                return redirect()->route('experience-trainer.index', ['trainer_id' => $trainer_id])->with('error', 'Experience Trainer failed to delete');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
