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

    public function getExperienceTrainerList(Request $request)
    {
        $data = ExperienceTrainer::with('trainer')->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<div class="table-actions">
                            <a href="' . route('experience-trainer.delete', ['trainer_id' => $data->trainer->id, 'id' => $data->id]) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
