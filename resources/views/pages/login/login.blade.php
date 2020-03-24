@extends('layouts.main')
@section('content')
    <section class="login_form_section">
        <div class="container">
            <div class="row">
            <div class="col-md-7 slider_text">
                <div class="login_slider_inner_txt">
                    <h1 class="slider_title">Welcome to Myscholarships.ng</h1>
                    <p class="slider_btm_txt mb-sm-5">
                    Myscholarship.ng is a premium online scholarship matching platform that uses mobile and web-based technologies to help students find free money for school. Join our platform today to start finding free money.
                    </p>
                </div>
            </div>
                <div class="col-md-5 mrgin-auto">
                    <div class="registration_form login_form">
                        <form class="loginForm" id="loginForm">
                            <h2 class="form_title">Login</h2>
                            <p class="form_subtitle mt-1">Please login to your account</p>
                            <div class="row pt-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter Your Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button id="submit" type="submit" class="btn form-btn">LOGIN <img class="login_btn_img" src="{{ url('assets/img/login/arrow.png') }}" alt=""></button>
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
@section('script')
    <script>
    $("#submit").click(function(e) {
        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'post-login',
            data: $("#loginForm").serialize(),
            success: function(response) {
                console.log(response);

                if (!$.isEmptyObject(response.error)) {
                    printErrorMsg(response.error);

                } else {

                    if (response.data) {
                        $("#msg").html(response.data);
                    } else {
                        if (response.success == "user") {
                            console.log("user");
                            window.location.href = "{{url('user')}}";

                        } else if (response.success == "partner") {
                            console.log("partner");
                            window.location.href = "{{url('partner')}}";

                        } else {
                            console.log("admin");
                            window.location.href = "{{url('admin')}}";

                        }
                        $("#loginForm")[0].reset();
                        $(".error").remove();
                    }

                }

            }
        });
    });

    function printErrorMsg(msg) {
        $(".error").remove();

        if (msg.email) {
            $("#email").after('<span class="error">' + msg.email + '</span>');
        }
        if (msg.password) {
            $("#password").after('<span class="error">' + msg.password + '</span>');
        }

        // console.log(msg);  
    }
    </script>
@endsection
