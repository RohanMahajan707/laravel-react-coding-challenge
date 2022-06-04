<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/dashboard')}}">Contactout Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item {{(Request::segment(2) == 'dashboard') ? 'active': ''}}">
                <a class="nav-link" href="{{url('/admin/dashboard')}}">Home</a>
            </li>
            <li class="nav-item {{(Request::segment(2) == 'referrals' || Request::segment(2) == 'referral-info') ? 'active': ''}}">
                <a class="nav-link" href="{{url('/admin/referrals')}}">Referrals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/logout')}}">Logout</a>
            </li>
           
        </ul>
    </div>
</nav>