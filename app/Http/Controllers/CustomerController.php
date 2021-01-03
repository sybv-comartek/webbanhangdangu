<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Customer;
use App\Category;
use App\Brand;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use App\Social;
use Socialite;
use App\User;
use App\Post;
use App\Gallery;
use App\CategoryPost;
use Hash;
use Str;
use Mail;
use App\Advertisement;
use App\Product;
session_start();
use Session;

class CustomerController extends Controller
{
    function __construct()
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = Category::where('category_status','0')->orderby('category_id','asc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
        $cate_post = CategoryPost::where('cate_post_status','0') ->orderby('cate_post_id','desc')->take(8)->get();
        $min_price =Product::min('product_price');
        $max_price =Product::max('product_price');
        $adv = Advertisement::where('adv_status','1')->get();
        $quangcaohome =0;
        View::share('adv',$adv);
        View::share('quangcaohome',$quangcaohome);
        View::share('min_price',$min_price);
        View::share('max_price',$max_price);
        View::share('category',$cate_product);
        View::share('brand',$brand_product);
        View::share('slider',$slider);
        View::share('cate_post',$cate_post);
    }
        public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = $request->password_account;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){

            return Redirect::to('/');
        }
        else {
            return Redirect::to('/dang-nhap')->with('thongbao','Tên tài khoản hoặc mật khẩu không đúng');
        }
    	// $result = Customer::where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	
    	// if($result){
           
    	// 	Session::put('customer_id',$result->customer_id);
     //        Session::put('customer_name',$result->customer_name);
    	// 	return Redirect::to('/checkout');
    	// }else{
    	// 	return Redirect::to('/dang-nhap');
    	// }
     //    Session::save();

    }
    public function add_customer(Request $request){

    	$this->validate($request,
        [
            'customer_name' => 'required|min:3',
            'customer_email' => 'required|email|unique:users,email',
            'customer_password'=>'required|min:3',

        ],
        [
            'customer_name.required'=>'Bạn chưa điền tên người dùng',
            'customer_name.min'=>'Tên người dùng có độ dài từ 3 đến 100 kí tự ',
            'customer_email.required'=>'Bạn chưa điền email người dùng',
            'customer_email.email'=>'Bạn chưa nhập đúng định dạng email',
            'customer_email.unique'=>'Email đã tồn tại',
            'customer_password.required'=>'Bạn chưa điền password người dùng',
            'customer_password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
        ]);

       $user = new User;
       $user->name = $request->customer_name;
       $user->email = $request->customer_email;
       $user->password = bcrypt($request->customer_password) ;
       $user->phone = $request->customer_phone;
       $user->role = 0;
       $user->save();
    	return Redirect::to('/dang-ky')->with('thongbao','Đăng kí thành công tài khoản của bạn');


    }
    public function logout_checkout(){
    	Auth::logout();
    	return Redirect::to('/dang-nhap');
    }
     public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
             
            $account_name = User::where('id',$account->user)->first();
            // dd($account_name->email);
            // if(Auth::attempt(['email'=>$account_name->email,'password'=>$account_name->password])){

                
            //  return Redirect::to('/checkout');
            // }
            Auth::loginUsingId($account->user, true);
            return Redirect::to('/');

        }else{

            $soci = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => bcrypt(Str::random(24)),
                    'phone' => '0966644598',
                    'role'=> '0',
                    
                ]);
            }
            $soci->login()->associate($orang);
            $soci->save();

            $account_name = User::where('id',$account->user)->first();
            // if(Auth::attempt(['email'=>$account_name->email,'password'=>$account_name->password])){

            // return Redirect::to('/checkout');
            // }
            Auth::loginUsingId($account->user, true);
            return Redirect::to('/');
        } 
    }

     public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
            $users = Socialite::driver('google')->stateless()->user(); 
            // // return $users->id;
            // return $users->name;
            // return $users->email;
            $authUser = $this->findOrCreateUser($users,'google');
            if($authUser) {
            $account_name = User::where('id',$authUser->user)->first();
            Auth::loginUsingId($authUser->user, true);
            }elseif ($soci) {
            $account_name = User::where('id',$authUser->user)->first();
            Auth::loginUsingId($authUser->user, true);
            }
            
            return Redirect::to('/');  
    }
    public function findOrCreateUser($users, $provider){
            $authUser = Social::where('provider_user_id', $users->id)->first();
            if($authUser){

                return $authUser;
            }else{
                 $soci = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = User::where('email',$users->email)->first();

                if(!$orang){
                    $orang = User::create([
                    'name' => $users->getName(),
                    'email' => $users->getEmail(),
                    'password' => bcrypt(Str::random(24)),
                    'phone' => '0966644598',
                    'role'=> '0',
                    
                ]);
                }

            $soci->login()->associate($orang);
                
            $soci->save();
            return $soci;
            }
          
           

            // $account_name = User::where('id',$soci->user)->first();
            // Auth::loginUsingId($soci->user, true);
            // return Redirect::to('/');

    }

    public function change_password(Request $request){
       
            $meta_desc = 'Đổi mật khẩu' ;
            $meta_keywords = 'Đổi mật khẩu';
            $meta_title = 'Đổi mật khẩu';
            $url_canonical = $request->url();
            //--seo
        return view('pages.checkout.change_passwordnew')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function save_password(Request $request){
        $this->validate($request,
        [
            'password_account'=>'required|min:3',
            'password_change' => 'required|'

        ],
        [
            'password_account.required'=>'Bạn chưa điền password người dùng',
            'password_account.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
            'password_change.required'=>'Bạn chưa nhập lại mật khẩu',

        ]);
        $check = User::where('email',$request->email_account)->first();;
        if(Hash::check($request->password_account,$check['password'])){
            $user = User::find($check['id']) ;
            $user->password = bcrypt($request->password_change);
            $user->save();
            return redirect('/change-password')->with('thongbao','Thay đổi mật khẩu thành công');
            
        }
        else{
            return redirect('/change-password')->with('thongbao','Thay đổi mật khẩu thất bại');
        }
    }
    public function forget_password(Request $request){
         $meta_desc = 'Quên mật khẩu' ;
            $meta_keywords = 'Quên mật khẩu';
            $meta_title = 'Quên mật khẩu';
            $url_canonical = $request->url();
            //--seo
        return view('pages.checkout.forget_password')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical'));
        
    }
    public function re_password(Request $request){
        $data = $request->all();
        $title_mail = 'Thông tin lấy lại mật khẩu của bạn';
        
        $customer = User::where('email','=',$data['email_account'])->get();
        foreach ($customer as $key => $value) {
            $id = $value->id;
        }
        
        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('error','Email chưa được đăng ký để khôi phục ');
            }else{
                $token_random = Str::random();
                $user = User::find($id);
                $user->remember_token = $token_random;
                $user->save();

                $to_mail = $data['email_account'];
                $link_reset = url('/update-new-password?email='.$to_mail .'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset,'email'=>$data['email_account']);

                Mail::Send('pages.checkout.forget_password_notice',['data'=>$data],function($message) use($title_mail,$data)
                    {
                        $message->to($data['email'])->subject($title_mail);
                        $message->from($data['email'],$title_mail);
                    });
                return redirect()->back()->with('message','Bạn vui lòng kiểm tra mail để thay đổi mật khẩu');
            }
        }
    }
    public function update_new_password(Request $request){

         $meta_desc = 'Lấy lại mật khẩu' ;
            $meta_keywords = 'Lấy lại mật khẩu';
            $meta_title = 'Lấy lại mật khẩu';
            $url_canonical = $request->url();
            //--seo
        return view('pages.checkout.new_password')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical'));
        
    }
    public function save_new_password(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = User::where('email','=',$data['email'])->where('remember_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach ($customer as $key => $cus) {
                $customer_id = $cus->id;
            }
            $reset = User::find($customer_id);
            $reset->password = bcrypt($data['password_account']);
            $reset->remember_token = $token_random;
            $reset->save();
            return redirect('dang-nhap')->with('thongbao','Mật khẩu đã cập nhật mới.Bạn có thể đăng nhập ngay');
        }else{
            return redirect('dang-nhap')->with('error','Link hết hạn. Vui lòng thao tác lại');
        }
    }
    public function metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical){
        View::share('meta_desc',$meta_desc);
        View::share('meta_keywords',$meta_keywords);
        View::share('meta_title',$meta_title);
        View::share('url_canonical',$url_canonical);
    }
    public function getlienhe(Request $request){
        //seo 
        $meta_desc = "Liên hệ đóng góp ý kiến người dùng "; 
        $meta_keywords = "Thiết bị điện tử chơi game, gaming cao cấp";
        $meta_title = "Thiết bị điện tử chơi game, gaming cao cấp";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);

        if(Auth::check())
        {
         return view('pages.contact.contactnew');
        }else{
            return view('pages.contact.contact_no_login');
        }


    }
}
