@extends('layouts.app')

@section('content')
@include('user.includes.navbar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <h4>Hi {{Auth::user()->first_name}}, <br><small>Welcome to Coding Challenge</small></h4>

            <p class="mt-3"><b>Total Referrals :</b> {{Auth::user()->referral_count}}</p>
            <p class="mt-3"><b>Total Invites :</b> {{count(Auth::user()->getInvitedUsers)}}</p>
        </div>
    </div>
</div>

@endsection('content')