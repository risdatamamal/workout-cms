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

class CertificationTrainerController extends Controller
{
    public function index($trainer_id)
    {
        $trainer = Trainer::findOrFail($trainer_id);
        return view('pages.trainer.certification.index', compact('trainer'));
    }

    public function getCertificationTrainerList(Request $request, $trainer_id)
    {
        $data = CertificationTrainer::where('trainer_id', $trainer_id)->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '<div class="table-actions">
                            <a href="' . route('certification-trainer.delete', ['trainer_id' => $data->trainer->id, 'id' => $data->id]) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($trainer_id)
    {
        try {
            return view('pages.trainer.certification.create', compact('trainer_id'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request, $trainer_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required | string',
            'code_name' => 'required | string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $certificationTrainer = CertificationTrainer::create([
                'trainer_id' => $trainer_id,
                'name' => $request->name,
                'code_name' => $request->code_name,
            ]);

            if ($certificationTrainer) {
                return redirect()->route('certification-trainer.index', ['trainer_id' => $trainer_id])->with('success', 'Certification Trainer created successfully');
            } else {
                return redirect()->route('certification-trainer.index', ['trainer_id' => $trainer_id])->with('error', 'Certification Trainer failed to create');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($trainer_id, $id)
    {
        try {
            $certificationTrainer = CertificationTrainer::where('trainer_id', $trainer_id)->findOrFail($id);

            if ($certificationTrainer) {
                $certificationTrainer->delete();
                return redirect()->route('certification-trainer.index', ['trainer_id' => $trainer_id])->with('success', 'Certification Trainer deleted successfully');
            } else {
                return redirect()->route('certification-trainer.index', ['trainer_id' => $trainer_id])->with('error', 'Certification Trainer failed to delete');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
