<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.dashboard.dashboard');
    }
    public function getChangePassword(){

        $data['user'] = Auth::user();

        if($data['user']->type =='Admin'){
            return View::make('admin.profile.password-change', $data);
        } else {
            return View::make('browser.profile.password-change', $data);
        }

    }
    public function postChangePassword(Request $request){

        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'password' => 'required|max:50|min:3|confirmed',
            'password_confirmation' => 'required|max:50|min:3',
        ]);

        if ($validator->fails()) {
            return redirect('/change-password')
                ->withErrors($validator)
                ->withInput();

        } else{

            $user = Auth::user();
            $user->password = bcrypt($inputs['password']);
            $user->save();

            $request->session()->flash('status', 'Password Updated successfully!');

            return redirect('/change-password');
        }
    }


    public function getProfile(){

        $data['user'] = Auth::user();

        if($data['user']->type =='Admin'){
            return View::make('admin.profile.profile', $data);
        } else {
            return View::make('browser.profile.profile', $data);
        }

    }

    public function postProfile(Request $request){

        $inputs = $request->all();


        $validator = Validator::make($inputs, [
            'firstName' => 'required|max:50|min:2',
            'lastName' => 'required|max:50|min:2',
            'gender' => 'required',
            'dateOfBirth' => 'required|max:30'
        ]);

        if ($validator->fails()) {
            return redirect('admin/member/add-new')
                ->withErrors($validator)
                ->withInput();
        } else{


            $user = Auth::user();
            $user->firstName = $inputs['firstName'];
            $user->lastName = $inputs['lastName'];
            $user->gender = $inputs['gender'];
            $user->profileTitle = $inputs['profileTitle'];
//            var_dump($inputs['dateOfBirth']);
//            var_dump(date('Y-m-d', strtotime($inputs['dateOfBirth'])));
//            echo '<hr>';
//            var_dump('14 August 2014');
//            var_dump(date('Y-m-d', strtotime('14 August 2014')));
            $user->dateOfBirth = date('Y-m-d', strtotime($inputs['dateOfBirth']));
//            $user->dateOfBirth = '2010-09-14';
//            var_dump($user->dateOfBirth);
//            exit();
            $user->save();

            $request->session()->flash('status', 'Updated successfully!');

            return redirect('/my-profile');
        }
    }

}
