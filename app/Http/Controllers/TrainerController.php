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
                $experienceTrainer = ExperienceTrainer::where('trainer_id', $dataTrainer->id)->get();
                $badge = '';
                if ($experienceTrainer != null && count($experienceTrainer) > 0) {
                    foreach ($experienceTrainer as $key => $experience) {
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
                $specialityTrainer = SpecialityTrainer::where('trainer_id', $dataTrainer->id)->get();
                $badge = '';

                if ($specialityTrainer != null && count($specialityTrainer) > 0) {
                    foreach ($specialityTrainer as $key => $speciality) {
                        $badge .= '<span class="badge badge-warning m-1">' . $speciality->speciality->name . '</span>';
                        $badge .= '<br>';
                    }
                } else {
                    $badge .= '<span class="badge badge-secondary m-1"> - </span>';
                }

                return $badge;
            })
            ->addColumn('certification', function ($data) {
                $dataTrainer = Trainer::where('user_id', $data->id)->first();
                $certificationTrainer = CertificationTrainer::where('trainer_id', $dataTrainer->id)->get();
                $badge = '';

                if ($certificationTrainer != null && count($certificationTrainer) > 0) {
                    foreach ($certificationTrainer as $key => $certification) {
                        $badge .= '<span class="badge badge-success m-1">' . $certification->code_name . '</span>';
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
                    $trainer = Trainer::where('user_id', $data->id)->first();

                    return '<div class="table-actions">
                                <a href="' . url('trainer/' . $trainer->id . '/experience') . '" ><i class="ik ik-pocket f-16 mr-10 text-blue"></i></a>
                                <a href="' . url('trainer/' . $trainer->id . '/speciality') . '" ><i class="ik ik-award f-16 mr-10 text-blue"></i></a>
                                <a href="' . url('trainer/' . $trainer->id . '/certification') . '" ><i class="ik ik-file-text f-16 mr-10 text-blue"></i></a>
                                <a href="' . url('trainer/edit/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-10 text-green"></i></a>
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

            $trainer = Trainer::create([
                'user_id'       => $user->id,
                'contract'      => $request->contract,
            ]);

            if ($request->contract != 0 || $request->contract != null) {
                $trainer = Trainer::create([
                    'contracted_at' => now()->format('Y-m-d'),
                ]);
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

    public function edit($id)
    {
        try {
            $user  = User::with('roles', 'permissions')->find($id);
            $trainer   = Trainer::where('user_id', $id)->first();

            if ($user && $trainer) {
                $user_role = $user->roles->first();
                $provinces = Province::all();
                $roles     = Role::where('name', 'Trainer')->pluck('name', 'id');

                return view('pages.trainer.edit', compact('user_role', 'roles', 'provinces', 'user', 'trainer'));
            } else {
                return redirect('trainer')->with('error', 'Trainer not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required | string ',
            'email'          => 'required | email',
            'phone_number'   => 'required | string',
            'contract'       => 'nullable | integer',
            'role'           => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $user = User::find($request->id);
            $trainer = Trainer::where('user_id', $request->id)->first();

            if ($user && $trainer) {
                $user->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'phone_number'  => $request->phone_number,
                    'province_id'   => $request->province_id == 0 ? null : $request->province_id,
                    'regency_id'    => $request->regency_id == 0 ? null : $request->regency_id,
                    'is_active'     => $request->is_active
                ]);

                $user->syncRoles($request->role);

                $trainer->update([
                    'contract' => $request->contract,
                ]);

                if ($request->contract != 0 || $request->contract != null) {
                    $trainer->update([
                        'contracted_at' => now()->format('Y-m-d'),
                    ]);
                } else {
                    $trainer->update([
                        'contracted_at' => null,
                    ]);
                }

                if ($user && $trainer) {
                    return redirect('trainer')->with('success', 'Trainer updated!');
                } else {
                    return redirect()->back()->with('error', 'Failed to update trainer! Try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Trainer not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $trainer = Trainer::where('user_id', $id)->first();
            ExperienceTrainer::where('trainer_id', $trainer->id)->delete();
            SpecialityTrainer::where('trainer_id', $trainer->id)->delete();
            CertificationTrainer::where('trainer_id', $trainer->id)->delete();

            if ($user && $trainer) {
                $user->removeRole('Trainer');
                $user->delete();
                $trainer->delete();

                return redirect('trainer')->with('success', 'Trainer deleted!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete trainer! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
}
