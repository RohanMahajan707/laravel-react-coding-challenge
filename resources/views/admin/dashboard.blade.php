@extends('layouts.app')

@section('content')
@include('admin.includes.navbar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <h4>Hi {{Auth::user()->first_name}}, <br><small>Welcome to Coding Challenge Admin Panel</small></h4>
        </div>
    </div>
</div>

@endsection('content')