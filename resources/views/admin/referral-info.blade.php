@extends('layouts.app')

@section('content')
@include('admin.includes.navbar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 mx-auto mt-5">
            <h5>List of Users with Referral Info</h5>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Referrer</th>
                    <th>Total Registered Referrals</th>
                    <th>Total Invites</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($referral_info as $info)
                    <tr>
                        <td>{{$info->first_name}} {{$info->last_name}}</td>
                        <td>{{$info->referral_count}}</td>
                        <td>{{count($info->getInvitedUsers) ?? 0}}</td>
                        <td>{{date('m/d/Y',strtotime($info->created_at))}}</td>
                        <td>{{($info->status == 1) ? 'Active' : 'Inactive'}}</td>
                        <td><a href="{{url('admin/referral-info/'.$info->id)}}" class="btn btn-sm btn-success">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$referral_info->links()}}
        </div>
    </div>
</div>

@endsection('content')