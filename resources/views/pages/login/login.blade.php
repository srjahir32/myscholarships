<!DOCTYPE html>
<html lang="en">

<head>
    <title>Myscholarships</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/media.css')}}">
</head>

<body class="login_page">
    <section class="login_page_header">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo">
                        <a href=""><img class="logo_img" src="{{ url('assets/img/Logo-white.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-sm-8">

                    <nav class="login_page_navbar navbar navbar-expand-lg navbar-light p-0">

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="login_page_navmenu navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('login') }}">Login </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link " href="{{ url('user-register') }}">Register </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link  scholarship_btn" href="{{ url('user-register') }}">Submit a Scholarship </a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="login_form_section">
        <div class="container">
            <div class="row">
            <div class="col-md-7 slider_text">
                <div class="login_slider_inner_txt">
                    <h1 class="slider_title">Welcome to Myscholarships.ng</h1>
                    <p class="slider_btm_txt">
                    Myscholarship.ng is a premium online scholarship matching platform that uses mobile and web-based technologies to help students find free money for school. Join our platform today to start finding free money.
                    </p>
                </div>
            </div>
                <div class="col-md-5 mrgin-auto">
                    <div class="registration_form login_form">
                        <form class="loginForm" id="loginForm">
                            <h2 class="form_title">Login</h2>
                            <p class="form_subtitle">Please login to your account</p>
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
                                    <button id="submit" type="submit" class="btn btn-danger form-btn">LOGIN <img class="login_btn_img" src="{{ url('assets/img/login/arrow.png') }}" alt=""></button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>





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
</body>

</html>