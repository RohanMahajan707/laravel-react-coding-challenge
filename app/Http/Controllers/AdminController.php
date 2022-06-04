<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function referrals()
    {
        $referral_info = User::where('role', 'user')->simplePaginate(10);
        return view('admin.referral-info', compact('referral_info'));
    }

    public function referral_info($id)
    {
        $user = User::find($id);
        return view('admin.referral-user-info', compact('user'));
    }
}
