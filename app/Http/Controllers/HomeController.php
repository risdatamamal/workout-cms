<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Biodata;
use App\Models\Infrastructure;
use App\Models\Management;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables, Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('clear-cache');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $user = User::find(Auth::user()->id);

            if (Hash::check($request->old_password, $user->password)) {
                if (isset($request->password)) {
                    $user->update(['password' => Hash::make($request->password)]);
                }

                return redirect('organizations')->with('success', 'Password updated!');
            } else {
                return redirect('organizations')->with('error', 'Old password does not match.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function updateBiodata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sk_no'             => 'required',
            'sk_date'           => 'required',
            'sk_valid_period'   => 'required',
            'sk_file_path'      => 'file|mimes:pdf|max:2048',
            'logo_path'         => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $biodata = Biodata::where('user_id', Auth::user()->id)->first();
            $user = User::where('id', Auth::user()->id)->first();

            if ($biodata) {
                if ($request->file('sk_file_path') != null) {
                    if ($biodata->sk_file_path != null) {
                        unlink('storage/' . $biodata->sk_file_path);
                        $biodata->update(['sk_file_path' => $request->hasFile('sk_file_path') ? $request->file('sk_file_path')->store('assets/biodata/sk', 'public') : null]);
                    } else {
                        $biodata->update(['sk_file_path' => $request->hasFile('sk_file_path') ? $request->file('sk_file_path')->store('assets/biodata/sk', 'public') : null]);
                    }
                }

                if ($request->file('logo_path') != null) {
                    if ($biodata->logo_path != null) {
                        unlink('storage/' . $biodata->logo_path);
                        $biodata->update(['logo_path' => $request->hasFile('logo_path') ? $request->file('logo_path')->store('assets/biodata/logo', 'public') : null]);
                    } else {
                        $biodata->update(['logo_path' => $request->hasFile('logo_path') ? $request->file('logo_path')->store('assets/biodata/logo', 'public') : null]);
                    }
                }

                $user->update(['name' => $request->username]);

                $biodata->update([
                    'sk_no' => $request->sk_no,
                    'sk_date' => $request->sk_date,
                    'sk_valid_period' => $request->sk_valid_period,
                    'name' => $request->name,
                    'chairman' => $request->chairman,
                    'contact_person_name' => $request->contact_person_name,
                    'contact_person_no' => $request->contact_person_no,
                    'address' => $request->address,
                ]);

                return redirect('organizations')->with('success', 'Biodata updated!');
            } else {
                return redirect('organizations')->with('error', 'Failed to update biodata! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function storeManagement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_name' => 'required',
            'stakeholder_name' => 'required',
            'photo_profile_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $management = Management::create([
                'user_id' => Auth::user()->id,
                'position_name' => $request->position_name,
                'stakeholder_name' => $request->stakeholder_name,
                'phone_number' => $request->phone_number,
                'photo_profile_path' => $request->hasFile('photo_profile_path') ? $request->file('photo_profile_path')->store('assets/management/photo', 'public') : null,
            ]);

            if ($management) {
                return redirect('organizations')->with('success', 'Management added!');
            } else {
                return redirect('organizations')->with('error', 'Failed to add new data management! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function destroyManagement($id)
    {
        try {
            $management = Management::find($id);

            if ($management) {

                if ($management->photo_profile_path != null) {
                    unlink('storage/' . $management->photo_profile_path);
                }
                $management->delete();

                return redirect('organizations')->with('success', 'Management deleted!');
            } else {
                return redirect('organizations')->with('error', 'Management not found');
            }


        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function storeInfrastructure(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sarpras_name' => 'required',
            'total' => 'required',
            'procurement_date' => 'required',
            'photo_sarpras_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $infrastructure = Infrastructure::create([
                'user_id' => Auth::user()->id,
                'sarpras_name' => $request->sarpras_name,
                'total' => $request->total,
                'good_status' => $request->good_status,
                'damage_status' => $request->damage_status,
                'procurement_date' => $request->procurement_date,
                'photo_sarpras_path' => $request->hasFile('photo_sarpras_path') ? $request->file('photo_sarpras_path')->store('assets/infrastructure/photo', 'public') : null,
            ]);

            if ($infrastructure) {
                return redirect('organizations')->with('success', 'Infrastructure added!');
            } else {
                return redirect('organizations')->with('error', 'Failed to add new data infrastructure! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function destroyInfrastructure($id)
    {
        try {
            $infrastructure = Infrastructure::find($id);

            if ($infrastructure) {

                if ($infrastructure->photo_sarpras_path != null) {
                    unlink('storage/' . $infrastructure->photo_sarpras_path);
                }
                $infrastructure->delete();

                return redirect('organizations')->with('success', 'Infrastructure deleted!');
            } else {
                return redirect('organizations')->with('error', 'Infrastructure not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function storeActivity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activity_name'       => 'required',
            'activity_date'       => 'required',
            'photo_activity_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $activity = Activity::create([
                'user_id'               => Auth::user()->id,
                'activity_name'         => $request->activity_name,
                'activity_date'         => $request->activity_date,
                'activity_desc'         => $request->activity_desc,
                'photo_activity_path'   => $request->hasFile('photo_activity_path') ? $request->file('photo_activity_path')->store('assets/activity/photo', 'public') : null
            ]);

            if ($activity) {
                return redirect('organizations')->with('success', 'Activity added!');
            } else {
                return redirect('organizations')->with('error', 'Failed to add new data activity! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function destroyActivity($id)
    {
        try {
            $activity = Activity::find($id);

            if ($activity) {

                if ($activity->photo_activity_path != null) {
                    unlink('storage/' . $activity->photo_activity_path);
                }
                $activity->delete();

                return redirect('organizations')->with('success', 'Activity deleted!');
            } else {
                return redirect('organizations')->with('error', 'Activity not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function storeAchievement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'championship_name'         => 'required',
            'championship_date'         => 'required',
            'medal'                     => 'required',
            'category'                  => 'required',
            'class'                     => 'required',
            'class_gender'              => 'required',
            'class_level'               => 'required',
            'supporting_photos_path'    => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $achievement = Achievement::create([
                'user_id'                   => Auth::user()->id,
                'championship_name'         => $request->championship_name,
                'championship_date'         => $request->championship_date,
                'championship_desc'         => $request->championship_desc,
                'medal'                     => $request->medal,
                'category'                  => $request->category,
                'class'                     => $request->class,
                'class_gender'              => $request->class_gender,
                'class_level'               => $request->class_level,
                'supporting_photos_path'    => $request->hasFile('supporting_photos_path') ? $request->file('supporting_photos_path')->store('assets/achievement/photo', 'public') : null
            ]);

            if ($achievement) {
                return redirect('organizations')->with('success', 'Achievement added!');
            } else {
                return redirect('organizations')->with('error', 'Failed to add new data achievement! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }

    public function destroyAchievement($id)
    {
        try {
            $achievement = Achievement::find($id);

            if ($achievement) {

                if ($achievement->supporting_photos_path != null) {
                    unlink('storage/' . $achievement->supporting_photos_path);
                }
                $achievement->delete();

                return redirect('organizations')->with('success', 'Achievement deleted!');
            } else {
                return redirect('organizations')->with('error', 'Achievement not found');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect('organizations')->with('error', $bug);
        }
    }
}
