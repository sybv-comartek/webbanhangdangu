<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Slider;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Category;
use App\Brand;
use App\Post;
use App\Gallery;
use App\CategoryPost;
use App\Product;
use Mail;
use App\User;
use App\Coupon;
use App\Advertisement;
class CheckoutController extends Controller
{
    function __construct()
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = Category::where('category_status','0')->orderby('category_id','desc')->get(); 
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
    public function metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical){
        View::share('meta_desc',$meta_desc);
        View::share('meta_keywords',$meta_keywords);
        View::share('meta_title',$meta_title);
        View::share('url_canonical',$url_canonical);
    }
    public function confirm_order(Request $request){
          $data = $request->all();
          print_r($data);
          $checkout_code = substr(md5(microtime()),rand(0,26),5);
          if(Session::get('coupon')==''){
             $coupon_mail = 'Không sử dụng';
         }else{
            $coupon_mail = Session::get('coupon');
         }
          $title_mail = 'Đơn hàng xác nhận ';
         //send mail 
         $customer = User::find(Auth::user()->getId());
         $data['email'][] = $customer->email;
         if (Session::get('cart')==true) {
             foreach (Session::get('cart') as $key => $cart_mail) {
                 $cart_array[]=array(
                    'product_name'=>$cart_mail['product_name'],
                    'product_price'=>$cart_mail['product_price'],
                    'product_qty'=>$cart_mail['product_qty']
                );
             }
         }

          if (Session::get('fee')==true) {
            $fee = Session::get('fee');
          }else{
             $fee='25000';
          }
         $shipping_array = array(
         'fee'=>$fee,
         'customer_name'=>$customer->name,
         'shipping_name'=>$data['shipping_name'],
         'shipping_email'=>$data['shipping_email'],
         'shipping_phone'=>$data['shipping_phone'],
         'shipping_address'=>$data['shipping_address'],
         'shipping_notes'=>$data['shipping_notes'],
         'shipping_method'=>$data['shipping_method']
        );
         $coupon_code = array(
            'coupon_code'=>$coupon_mail,
            'order_code'=>$checkout_code
         );
       
         Mail::send('pages.mail.mail_accept_order',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$coupon_code],function($message)use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
         });

         $shipping = new Shipping;
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         

  
         $order = new Order;
         $order->customer_id = Auth::user()->getId();
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->created_at = now();
         $order->save();

         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
         }

         Session::forget('coupon');
         Session::forget('fee');
         Session::forget('cart');

    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }


    public function calculate_fee(Request $request){
        $data = $request->all();
        $output = 'Phí vận chuyển : ';
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        $output.=$fee->fee_feeship;
                        $output.=' vnđ';
                        // $phiship = $fee->fee_feeship;
                        // View::share('phiship',$phiship);
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                        echo $output;

                    }
                }else{ 
                    $output.= 25000;
                    $output.=' vnđ';
                    // $phiship =25000;
                    // View::share('phiship',$phiship);
                    Session::put('fee',25000);
                    Session::save();
                    echo $output;
                }
            }
           
        }
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    public function view_order($orderId){

        $order_by_id = Order::join('users','tbl_order.customer_id','=','users.id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','users.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(Request $request){

        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo 

    	return view('pages.checkout.login_checkoutnew');
    }
    public function dang_ky(Request $request){

        //seo 
        $meta_desc = "Đăng ký tài khoản"; 
        $meta_keywords = "Đăng ký tài khoản";
        $meta_title = "Đăng ký tài khoản";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo 

      return view('pages.checkout.signup_checkoutnew');
    }
    // public function add_customer(Request $request){

    // 	$data = array();

    // 	$data['customer_name'] = $request->customer_name;
    // 	$data['customer_phone'] = $request->customer_phone;
    // 	$data['customer_email'] = $request->customer_email;
    // 	$data['customer_password'] = md5($request->customer_password);

    // 	$customer_id = Customer::insertGetId($data);

    // 	Session::put('customer_id',$customer_id);
    // 	Session::put('customer_name',$request->customer_name);
    // 	return Redirect::to('/checkout');


    // }
    public function checkout(Request $request){
         //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo 
        $city = City::orderby('matp','ASC')->get();

    	return view('pages.checkout.show_checkoutnew')->with('city',$city);
    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = Shipping::insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(Request $request){
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo 
        return view('pages.checkout.payment');

    }
    public function order_place(Request $request){
        //insert payment_method
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo 
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        // $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Auth::user()->id;
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = Order::insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            OrderDetails::insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }elseif($data['payment_method']==2){
            Cart::destroy();

            return view('pages.checkout.handcash');

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }

    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = Order::join('users','tbl_order.customer_id','=','users.id')
        ->select('tbl_order.*','users.name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
