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
                $badge = '';
                if ($dataTrainer['experience'] != null) {
                    foreach ($dataTrainer['experience'] as $key => $experience) {
                        $badge .= '<span class="badge badge-primary m-1">' . $experience['year'] . ' ' . $experience['company'] . '</span>';

                        $badge .= '<br>';
                    }
                } else {
                    $badge .= '<span class="badge badge-secondary m-1"> - </span>';
                }
                return $badge;
            })
            ->addColumn('speciality', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                $badge = '';

                if ($dataTrainer['speciality'] != null) {
                    foreach ($dataTrainer['speciality'] as $key => $speciality) {
                        $badge .= '<span class="badge badge-warning m-1">' . $speciality . '</span>';
                        $badge .= '<br>';
                    }
                } else {
                    $badge .= '<span class="badge badge-secondary m-1"> - </span>';
                }

                return $badge;
            })
            ->addColumn('certification', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                $badge = '';

                if ($dataTrainer['certification'] != null) {
                    foreach ($dataTrainer['certification'] as $key => $certification) {
                        $badge .= '<span class="badge badge-success m-1">' . $certification['code_name'] . '</span>';
                        $badge .= '<br>';
                    }
                } else {
                    $badge .= '<span class="badge badge-secondary m-1"> - </span>';
                }

                return $badge;
            })
            ->addColumn('status', function ($data) {
                $userActive = $data->is_active;
                $badges = '';
                if ($userActive == 1) {
                    $badges .= '<span class="badge badge-success m-1">Active</span>';
                } else {
                    $badges .= '<span class="badge badge-danger m-1">Inactive</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                if (Auth::user()->id == $data->id) {
                    return '';
                }
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('trainer/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('trainer/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['status', 'contract', 'experience', 'speciality', 'certification', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $provinces = Province::all();
            $roles     = Role::where('name', 'Trainer')->pluck('name', 'id');

            return view('pages.trainer.create', compact('roles', 'provinces'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required | string ',
            'email'          => 'required | email | unique:users',
            'phone_number'   => 'required | string',
            'password'       => 'required | confirmed',
            'role'           => 'required',
            'contract'       => 'nullable | integer',
            // 'experiences'    => 'nullable | json',
            // 'specialities'   => 'nullable | json',
            // 'certifications' => 'nullable | json'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone_number'  => $request->phone_number,
                'password'      => Hash::make($request->password),
                'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id,
                'is_active'     => $request->is_active
            ]);

            $user->syncRoles($request->role);

            // $experience = json_decode($request->experiences, true);
            // $speciality = json_decode($request->specialities, true);
            // $certification = json_decode($request->certifications, true);

            // $experience = [];
            // $speciality = [];
            // $certification = [];

            // if ($request->experiences != null) {
            //     $experienceData = json_decode($request->experiences, true);
            //     foreach ($experienceData as $key => $value) {
            //         $experience[] = [
            //             'year' => $value['year'],
            //             'company' => $value['company'],
            //             'position' => $value['position']
            //         ];
            //     }
            // }

            // if ($request->specialities != null) {
            //     $specialityData = json_decode($request->specialities, true);
            //     foreach ($specialityData as $key => $value) {
            //         $speciality[] = $value;
            //     }
            // }

            // if ($request->certifications != null) {
            //     $certificationData = json_decode($request->certifications, true);
            //     foreach ($certificationData as $key => $value) {
            //         $certification[] = [
            //             'name' => $value['name'],
            //             'code_name' => $value['code_name']
            //         ];
            //     }
            // }

            $trainer = Trainer::create([
                'user_id'       => $user->id,
                'contract'      => $request->contract,
                // 'experience'    => $experience,
                // 'speciality'    => $speciality,
                // 'certification' => $certification
            ]);

            if ($request->contract != 0 || $request->contract != null) {
                $trainer->contracted_at = now()->format('Y-m-d');
            }

            if ($user && $trainer) {
                return redirect('trainer')->with('success', 'New trainer created!');
            } else {
                return redirect()->back()->with('error', 'Failed to create new trainer! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
