<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        session(['reset_phone' => $request->phone]);
        session(['otp' => '1234']);  

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully!',
            'otp' => '1234'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        if ($request->otp === session('otp')) {
            return response()->json(['status' => 'verified']);
        }

        return response()->json(['status' => 'error'], 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6'
        ]);

        $user = User::where('phone', session('reset_phone'))->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(['status' => 'success']);
    }
}
