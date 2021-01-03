<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Social;
use Socialite;
use App\Admin;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Rules\Captcha; 
use Auth;
use App\User;
class AdminController extends Controller
{

    public function index(){
    	return view('admin_login');
    }
    public function show_dashboard(){
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        //$data = $request->all();
        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required',
            'admin_password' => 'required',
           'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        ]);

        $admin_email = $data['admin_email'];
        $admin_password = $data['admin_password'];
        if(Auth::attempt(['email'=>$admin_email,'password'=>$admin_password])){

            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Mật khẩu hoặc tài khoản bị sai. Vui lòng nhập lại');
            return Redirect::to('/admin');
        }
        // $login = Admin::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        // if($login){
        //     $login_count = $login->count();
        //     if($login_count>0){
        //         Session::put('admin_name',$login->admin_name);
        //         Session::put('admin_id',$login->admin_id);
        //         return Redirect::to('/dashboard');
        //     }
        // }else{
        //         Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
        //         return Redirect::to('/admin');
        // }
       

    }
    public function logout(){
        Auth::logout();
        return Redirect::to('/admin');
    }
}
