@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="registration_form">
                <form class="registration" id="partner_registration">
                    @csrf
                    <h2 class="text-center">Registration</h2>
                    <div class="row pt-4">
                        <input type="hidden" name="role" id="role" value="partner">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="firstname" name="firstname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lastname" name="lastname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Confrim Password</label>
                                <input type="password" class="form-control" id="confirmpassword"
                                    placeholder="Confrim Password" name="confirmpassword">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button> 
                            <p> Already have an account? <a class="p" href="{{url('login')}}"><b>Login!</b></a></small>
                        </div>
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
            url:'post-registration',
            data:$("#partner_registration").serialize(),
            success:function(response){
                console.log(response);
                if ($.isEmptyObject(response.error)) {
                    $("#partner_registration")[0].reset();
                    $(".error").remove();
                } else {
                    printErrorMsg(response.error);
                }
            }
        });
    });

    function printErrorMsg(msg) {
        $(".error").remove();

        if (msg.firstname) {
            $("#firstname").after('<span class="error">' + msg.firstname + '</span>');
        }
        if (msg.lastname) {
            $("#lastname").after('<span class="error">' + msg.lastname + '</span>');
        }
        if (msg.email) {
            $("#email").after('<span class="error">' + msg.email + '</span>');
        }
        if (msg.phone) {
            $("#phone").after('<span class="error">' + msg.phone + '</span>');
        }
        if (msg.password) {
            $("#password").after('<span class="error">' + msg.password + '</span>');
        }
        if (msg.confirmpassword) {
            $("#confirmpassword").after('<span class="error">' + msg.confirmpassword + '</span>');
        }

        console.log(msg);  
    }


</script>
@endsection