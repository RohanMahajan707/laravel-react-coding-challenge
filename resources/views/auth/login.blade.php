@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto form">
            <div class="col-md-12 text-center">
                <h1>Login</h1>
            </div>
            <div class="col-md-12">
                @if(Session::has('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif

                @if(Session::has('error'))
                    <p class="alert alert-danger">{{Session::get('error')}}</p>
                @endif

                @if(!empty($errors))
                    @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                    @endforeach
                @endif

                <form action="{{url('/login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class=" btn btn-block btn-primary">Login</button>
                    </div>
                    <div class="form-group mt-3">
                        <p class="text-center">Don't have account? <a href="{{url('/register')}}">Register here</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection