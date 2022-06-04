@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto form">
            <div class="col-md-12 text-center">
                <h1>Register</h1>
            </div>
            <div class="col-md-12">
                @if(!empty($errors))
                <div>
                    @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{url('/register')}}" method="post">
                    @csrf
                    <input type="hidden" name="refer_code" value="{{$refer_code}}">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="first_name" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name" value="{{old('first_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Last Name</label>
                        <input type="last_name" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name" value="{{old('last_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                    </div>
                    <div class="form-group mt-3">
                        <p class="text-center">Already have account? <a href="{{url('/')}}">Login here</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection