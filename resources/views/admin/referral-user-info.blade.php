@extends('layouts.app')

@section('content')
@include('admin.includes.navbar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto mt-5">
            <h3><u>User Information</u></h3>
            <div class="row mt-4">
                <div class="col-md-4">
                    <label class="info-heading">First Name</label>
                    <p class="info-text">{{$user->first_name}}</p>
                </div>
                <div class="col-md-4">
                    <label class="info-heading">Last Name</label>
                    <p class="info-text">{{$user->last_name}}</p>
                </div>
                <div class="col-md-4">
                    <label class="info-heading">Email</label>
                    <p class="info-text">{{$user->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="info-heading">Referral Code</label>
                    <p class="info-text">{{$user->referral_code}}</p>
                </div>
                <div class="col-md-4">
                    <label class="info-heading">Referral Count</label>
                    <p class="info-text">{{$user->referral_count}}</p>
                </div>
            </div>
            <hr>
            <h5>List of Invites</h5>
            <table class="table table-bordered">
                <thead>
                    <th>Email</th>
                    <th>Sent Date</th>
                </thead>
                <tbody>
                    @forelse($user->getInvitedUsers as $invited)
                    <tr>
                        <td>{{$invited->invited_email}}</td>
                        <td>{{date('m/d/Y',strtotime($invited->created_at))}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan=2>No Record Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <hr>
            <h5>List of Registered Referrals</h5>
            <table class="table table-bordered">
                <thead>
                    <th>Email</th>
                    <th>Created Date</th>
                </thead>
                <tbody>
                    @forelse($user->getRegisteredUsers as $invited)
                    <tr>
                        <td>{{$invited->email}}</td>
                        <td>{{date('m/d/Y',strtotime($invited->created_at))}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan=2>No Record Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection('content')