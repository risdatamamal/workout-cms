<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;

class TrainerController extends Controller
{
    public function index()
    {
        return view('pages.trainer.index');
    }

    public function getTrainerList(Request $request)
    {
        $data  = User::whereHas('roles', function ($query) {
            $query->where('name', 'Trainer');
        })->get();

        return DataTables::of($data)
            ->addColumn('membership', function ($data) {
                $userActive = $data->is_active;
                $badges = '';
                if ($userActive == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('contract', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                if ($dataTrainer['contract'] > 1) {
                    return $dataTrainer['contract'] . ' Years';
                } else {
                    return $dataTrainer['contract'] . ' Year';
                }
            })
            ->addColumn('experience', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                return $dataTrainer['experience'][0]['year'];
                // if ($dataTrainer['experience'] != null) {
                //     return $dataTrainer['experience'] . ' Years';
                // } else {
                //     return $dataTrainer['experience'] . ' Year';
                // }
            })
            ->addColumn('speciality', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                $badge = '';

                if ($dataTrainer['speciality'] != null) {
                    foreach ($dataTrainer['speciality'] as $key => $speciality) {
                        $badge .= '<span class="badge badge-primary m-1">' . $speciality . '</span>';
                    }
                } else {
                    $badge = '<span class="badge badge-secondary m-1"> - </span>';
                }

                return $badge;
            })
            ->addColumn('certification', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                $badge = '';

                if ($dataTrainer['certification'] != null) {
                    foreach ($dataTrainer['certification'] as $key => $certification) {
                        $badge .= '<span class="badge badge-success m-1">' . $certification['code_name'] . '</span>';
                    }
                } else {
                    $badge = '<span class="badge badge-secondary m-1"> - </span>';
                }

                return $badge;
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
            ->rawColumns(['membership', 'contract', 'experience', 'speciality', 'certification', 'action'])
            ->make(true);
    }
}
