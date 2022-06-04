<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $refer_code = $request->input('refer');
        return view('auth.register')->with('refer_code', $refer_code);
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 'admin')
                return redirect('/admin/dashboard');
            else
                return redirect('/dashboard');
        } else
            return redirect('/')->withError('Incorrect Crendentials');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        /* Check if referral code correct */
        if (!empty($request->input('refer_code'))) {
            $refer_code = $request->input('refer_code');
            $checkReferral = User::where('referral_code', $refer_code)->first();

            if (empty($checkReferral))
                return redirect()->back()->withErrors(['refer_code' => 'Incorrect Referral Code']);

            if (!empty($checkReferral) && $checkReferral->referral_count >= 10)
                return redirect()->back()->withErrors(['refer_code' => 'Sorry! User has already reached the limit of 10 referrals']);

            $user_id = $checkReferral->id;
            $referral_count = $checkReferral->referral_count;

            /* Increment Referral Count */
            $checkReferral->referral_count = $referral_count + 1;
            $checkReferral->save();
        }

        /* Insert User */
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->referral_code = $user->first_name . Str::random(4);
        $user->referral_parent_id = $user_id ?? 0;
        $user->save();

        return redirect(url('/'))->with('success', 'You have successfully registered. Please Login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
