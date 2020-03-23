@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="registration_form">
                <form class="registration" id="user_registration">
                    <h2 class="text-center">Registration</h2>
                    <div class="row pt-4">
                        <input type="hidden" name="role" id="role" value="user">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="firstname"
                                    name="firstname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lastname"
                                    name="lastname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate">Date of Birth</label>

                                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy">
                                    <input class="form-control" type="text" name="birthdate" id="birthdate" />
                                    <span class="btn btn-primary calender_icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City </label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="city">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="area_of_interest">Areas of Interests</label>
                                <select type="text" class="form-control" id="area_of_interest"
                                    placeholder="area_of_interest" name="area_of_interest">
                                    <option value="">Select Ares</option>
                                    <option value="Science">Science</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Math">Math</option>
                                    <option value="Medicine">Medicine</option>
                                    <option value="Social Science">Social Science</option>
                                    <option value="Education">Education</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Recreation">Recreation</option>
                                    <option value="Entrepreneurship">Entrepreneurship</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                                    placeholder="Confrim Password">
                            </div>
                        </div>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="I agree to the Terms of Use & Privacy Policy." id="terms"> I
                            agree to the
                            Terms of Use & Privacy Policy.
                        </label>
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
<script type="text/javascript">
$('#datepicker').datepicker({
    format: 'dd/mm/yyyy',
});

$("#submit").click(function(e) {
    e.preventDefault();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: 'post-registration',
        data: $("#user_registration").serialize(),
        success: function(response) {
            console.log(response);
            if (response == "success") {
                $("#user_registration")[0].reset();
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