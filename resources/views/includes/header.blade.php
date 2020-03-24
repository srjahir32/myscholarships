<section class="page_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="logo">
                    <a href=""><img class="logo_img" src="{{ url('assets/img/Logo-white.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-8 col-sm-6">

                <nav class=" navbar navbar-expand-lg navbar-light p-0">

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class=" navbar-nav mr-auto">
                            @if( auth()->check() )
                            <li class="nav-item ">
                                <a class="nav-link " href=""><span>Home</span></a>
                            </li>
                            <li class="nav-item ">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </li>
                            @else
                            <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                                <a class="nav-link " href="{{ url('login') }}"><span>Login</span></a>
                            </li>
                            <li class="nav-item {{ (request()->is('register')) ? 'active' : '' }}">
                                <a class="nav-link " href="{{ url('register') }}"><span>Register</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  scholarship_btn" href="{{ url('user-register') }}">Submit a
                                    Scholarship </a>
                            </li>
                            @endif
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{url('logout')}}">Logout</a>
            </div>
        </div>
    </div>
</div>