@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mrgin-auto">
            <div class="registration_form login_form">
                <form class="loginForm" id="loginForm">
                    <h2 class="text-center">Login</h2>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email"  name="email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                            <p> <a class="small" href="{{url('registration')}}">Create an Account!</a></small>
                        </div>
                    </div>
                    <p id="msg" class="text-center error"></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#submit").click(function(e){
    e.preventDefault();
    
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'post-login',
            data:$("#loginForm").serialize(),
            success:function(response){
                console.log(response);
                
                if (!$.isEmptyObject(response.error)) {
                    printErrorMsg(response.error);
                    
                }else {
                   
                    if (response.data) {
                        $("#msg").html(response.data);
                    }
                    else{
                        if(response.success == "user"){
                            console.log("user");
                            window.location.href = "{{url('user')}}";

                        }
                        else if(response.success == "partner"){
                            console.log("partner");
                            window.location.href = "{{url('partner')}}";

                        }
                        else{
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