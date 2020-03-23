<?php

namespace App\Http\Controllers;

use App\User;
use App\Userlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Response;
use Session;
use Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages/login/login');
    }

    public function userregistration()
    {
        return view('pages/registration/user');
    }

    public function partnerregistration()
    {
        return view('pages/registration/partner');
    }

    public function postRegistration(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'sometimes|nullable|digits:10',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
            $data = $request->all();
            if (!empty($data['birthdate'])) {
                $birthdate = $data['birthdate'];
            } else {
                $birthdate = "";
            }
            if (!empty($data['city'])) {
                $city = $data['city'];
            } else {
                $city = "";
            }
            if (!empty($data['area_of_interest'])) {
                $area_of_interest = $data['area_of_interest'];
            } else {
                $area_of_interest = "";
            }

            User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'birthdate' => $birthdate,
                'city' => $city,
                'area_of_interest' => $area_of_interest,
                'role' => $data['role'],
                'password' => Hash::make($data['password']),
            ]);
            return response('success');
        }
    }

    public function postLogin(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
            // $credentials = $request->only('email', 'password');
            if (Auth::attempt($request->all())) {

                $user_id = User::where('email', $request->input('email'))->value('id');

                Userlogin::Insert(['user_id' => $user_id, 'login_time' => date('Y-m-d H:i:s')]);


                if (auth()->user()->role == 'admin') {
                    return response()->json(['success' => 'admin']);
                } 
                else if (auth()->user()->role == 'user') {
                    return response()->json(['success' => 'user']);
                } 
                else{
                    return response()->json(['success' => 'partner']);
                }

               
            } 
            else {
                return response()->json(['data' => 'Oppes! You have entered invalid credentials']);

            }
            
        }
    }

    public function dashboard()
    {

        if (Auth::check()) {
            return view('dashboard');
        }
        return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }

    // public function create(array $data)
    // {
    //   return User::create([
    //     'firstname' => $data['firstname'],
    //     'lastname' => $data['lastname'],
    //     'email' => $data['email'],
    //     'phone' => $data['phone'],
    //     'birthdate' => $dat['birthdate'],
    //     'city' => $dat['city'],
    //     'area_of_interest' => $dat['area_of_interest'],
    //     'role' => $data['role'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    // }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
