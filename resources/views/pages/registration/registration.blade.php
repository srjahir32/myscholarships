@extends('layouts.main')
@section('content')
    <section class="registration_form_section">
        <div class="container">
            <div class="row">
                <div class="col-md-7 slider_text">
                    <div class="login_slider_inner_txt">
                        <h1 class="slider_title">Welcome to Myscholarships.ng</h1>
                        <p class="slider_btm_txt">
                            Myscholarship.ng is a premium online scholarship matching platform that uses mobile and
                            web-based technologies to help students find free money for school. Join our platform today
                            to start finding free money.
                        </p>
                    </div>
                </div>
                <div class="col-md-5 mrgin-auto">
                    <div class="registration_form login_form">
                        <form class="loginForm" id="loginForm">
                            <h2 class="form_title">Register</h2>
                            <p class="form_subtitle mt-1">Join us now to start finding free money</p>
                            <div class="row pt-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="phone" id="phone"
                                            placeholder="Enter Your Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter Your Password">
                                    </div>
                                    <label class="checkbox_label">I agree to the Terms of Use and <a href="http://" class="themecolor">Privacy Policy.</a>
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn form-btn">REGISTER <img
                                            class="login_btn_img" src="{{ url('assets/img/login/arrow.png') }}"
                                            alt=""></button>
                                    <!-- <p> <a class="small" href="{{url('registration')}}">Create an Account!</a></small> -->
                                </div>
                            </div>
                            <p id="msg" class="text-center error"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
