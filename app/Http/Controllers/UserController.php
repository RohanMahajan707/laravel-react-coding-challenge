<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvitedEmails;
use App\Models\User;
use App\Mail\InviteEmail;
use Mail;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function referrals()
    {
        return view('user.referrals');
    }

    public function insertInvites(Request $request)
    {
        $request->validate([
            'emailList' => 'required'
        ]);

        $user_id = Auth::user()->id;
        $referralCount = Auth::user()->referral_count;

        $emailList = $request->input('emailList');

        if (empty($emailList))
            return response()->json(['status' => false, 'message' => 'Email cannot be empty']);

        if ($referralCount >= 10)
            return response()->json(['status' => false, 'message' => 'Please Upgrade. You have already reached the limit of 10 referrals']);
        
        $checkInvite = InvitedEmails::where('user_id', $user_id)->whereIn('invited_email', $emailList)->first();
        if (!empty($checkInvite))
            return response()->json(['status' => false, 'message' => 'Given emails are alreay invited']);

        $checkEmail = User::whereIn('email', $emailList)->first();
        if (!empty($checkEmail))
            return response()->json(['status' => false, 'message' => 'User are already registered with given emails']);


        $insertList = array();
        foreach ($emailList as $emails) {
            $insertList[] = array('user_id' => $user_id, 'invited_email' => $emails, 'created_at' => now());
        }

        $insert = InvitedEmails::insert($insertList);

        if ($insert) {

            //send invite email 
            $details = ['first_name'=>Auth::user()->first_name,
                        'referral_link'=> url('/register?refer=' . Auth::user()->referral_code)];

            foreach ($emailList as $email) {
                Mail::to($email)->send(new InviteEmail($details));
            }

            return response()->json(['status' => true, 'message' => 'Invite sent successfully']);
        } else
            return response()->json(['status' => false, 'message' => 'Something went wrong']);
    }
}