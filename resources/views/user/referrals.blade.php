@extends('layouts.app')

@section('content')
@include('user.includes.navbar')
<div id="referral_div"></div>

<script>
    const code = @json(Auth::user()->referral_code);
    const register_url = "{{ url('/register')}}";
</script>

<script src="{{asset('js/app.js')}}"></script>
@endsection('content')