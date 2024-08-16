<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show(Request $request)
    {
        return response(['message' => 'Please verification email address!', 'success' => 1]);
    }

    public function verify(Request $request)
    {
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response(['message' => 'Email verified!', 'success' => 1]);
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response(['message' => 'Email verification link sent!', 'success' => 1]);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response(['message' => 'Email already verified!', 'success' => 0]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response(['message' => 'Email verification link sent!', 'success' => 1]);
    }
}
