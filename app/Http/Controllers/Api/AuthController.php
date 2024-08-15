<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validData = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8']
            ]);

            if ($validData->fails()) {
                return ResponseFormatter::error([
                    'message' => 'Invalid email or password',
                ], 'Authentication Failed', 400);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $user = Auth::user();

            if ($user) {
                $accessToken = Auth::user()->createToken('authToken')->accessToken;
                $roles = $user->getRoleNames();
                $permission = $user->getAllPermissions();

                return ResponseFormatter::success([
                    'user'         => $user,
                    'roles'        => $roles,
                    // 'permission'   => $permission,
                    'token_type'   => 'Bearer',
                    'access_token' => $accessToken
                ], 'Authenticated');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Your account can\'t to access.'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'     => 'required | string | max:255',
                'email'    => 'required | string | email | max:255 | unique:users',
                'password' => 'required | string | min:8',
                'password_confirmation' => 'required | string | min:8 | same:password',
                'phone_number' => 'required | string | max:255',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'message' => 'Invalid input',
                ], 'Registration Account Failed', 400);
            }

            $user = User::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'is_active'    => 1,
                // 'province_id'  => $request->province_id == 0 ? null : $request->province_id,
                // 'regency_id'   => $request->regency_id == 0 ? null : $request->regency_id
            ]);

            $userToken = User::where('email', $request->email)->first();

            $customer = Member::create([
                'user_id' => $user->id,
                'member_plan_id' => 1
            ]);

            $user->assignRole('Customer');

            if ($user && $customer) {
                $accessToken = $userToken->createToken('authToken')->accessToken;
                $roles = $user->getRoleNames();

                return ResponseFormatter::success([
                    'user' => $user,
                    'roles' => $roles,
                    'token_type' => 'Bearer',
                    'access_token' => $accessToken,
                ], 'Registration success');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Registration failed'
                ], 'Registration Account Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error
            ], 'Registration Account Failed', 500);
        }
    }

    public function profile(Request $request)
    {
        try {
            $user = Auth::user();

            if ($user) {
                $roles = $user->getRoleNames();
                $permission = $user->getAllPermissions();

                return ResponseFormatter::success([
                    'user'       => $user,
                    'roles'      => $roles,
                    // 'permission' => $permission,
                ], 'Get profile success');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized.'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Get Profile Failed', 500);
        }
    }


    public function changePassword(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'old_password' => 'required|string',
                'password' => 'required|string|confirmed'
            ]);

            // Match old password
            $user = Auth::user();
            if ($user) {
                if (Hash::check($request->old_password, $user->password)) {
                    User::find($user->id)
                        ->update([
                            'password' => Hash::make($request->password)
                        ]);

                    return ResponseFormatter::success([
                        'status' => 1,
                    ], 'Password has been changed');
                } else {
                    return ResponseFormatter::error([
                        'message' => 'Password not matched!'
                    ], 'Change Password Failed', 500);
                }
            } else {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Change Password Failed', 500);
        }
    }


    public function updateProfile(Request $request)
    {
        try {
            $validData = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email'
            ]);

            $user = Auth::user();
            if ($user) {
                // Check unique email except this user
                if (isset($request->email)) {
                    $check = User::where('email', $request->email)
                        ->where('id', '!=', $user->id)
                        ->count();

                    if ($check > 0) {
                        return response([
                            'message' => 'The email address is already used!',
                            'success' => 0
                        ]);
                    }
                }

                $user->update($validData);

                return ResponseFormatter::success([
                    'status' => 1,
                ], 'Profile updated successfully!');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Update Profile Failed', 500);
        }
    }


    public function logout(Request $request)
    {
        try {
            $user = Auth::user()->token();

            if ($user) {
                $user->revoke();

                return ResponseFormatter::success([
                    'status' => 0,
                ], 'Logged out succesfully!');
            } else {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Logout Failed', 500);
        }
    }
}
