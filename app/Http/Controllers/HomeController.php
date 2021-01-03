<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Http\Requests;
use Mail;
use App\Slider;
use App\Product;
use App\Category;
use App\Brand;
use App\Rating;
use App\Post;
use App\CategoryPost;
use App\Advertisement;
use App\Recommend\Recommend;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();

class HomeController extends Controller
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
        $quangcaohome = 1;
        View::share('quangcaohome',$quangcaohome);
        View::share('adv',$adv);
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

    
    public function send_mail(Request $request){
        $meta_desc = "Liên hệ đóng góp ý kiến người dùng "; 
        $meta_keywords = "Thiết bị điện tử chơi game, gaming cao cấp";
        $meta_title = "Thiết bị điện tử chơi game, gaming cao cấp";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
                $to_name = "Dahoang ";
                $to_email = "dahoang2311998@gmail.com";
               
             
                $data = array("name"=>$request->hoten,"mail"=>$request->email,"body"=>$request->comment); 
                
                Mail::send('pages.contact.send_mail',$data,function($message) use ($to_name,$to_email){

                    $message->to($to_email)->subject('Mail từ khách hàng ');
                    $message->from($to_email,$to_name);
                });
                return view('pages.contact.contact_success');
                
    }

    public function index(Request $request){
        //slide
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện điện tử hỗ trợ gaming, đỉnh cao của gaming"; 
        $meta_keywords = "Thiết bị điện tử chơi game, gaming cao cấp";
        $meta_title = "Thiết bị điện tử chơi game, gaming cao cấp";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo
        
        $all_product = Product::where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(9);

        if(Auth::check()){
        $name = Auth::user()->name;
        $check = Rating::where('customer_name',$name)->first();
        if($check!=NULL){
                $ischeck = 1;
                $data= array();
                $rating_recom = Rating::all();
                foreach($rating_recom as $rate)
                {
                    $username = $rate->customer_name;
                    $productname = $rate->product_name;
                    $ratings = $rate->rating;
                    $data[$username][$productname] = $ratings;  
                }
                $product_recomendation = array();
                $re = new Recommend();
                $related_product_recom= $re->getRecommendations($data, Auth::user()->name);
                $related_product_recom_splice = array_splice($related_product_recom,0,18);
                $related_product = array();
                 foreach ($related_product_recom_splice as $productname => $rating) {
                    
                        $product_r= Product::where('product_name',$productname)->first();
                          array_push($related_product, $product_r);
                    
              
                        }
                $related_one= array_splice($related_product,0,6);
                $related_two= array_splice($related_product,6,12);
                //$related_three= array_splice($related_product,6,9);
                // return view('pages.home')->with('all_product',$all_product)->with('relate',$related_product)->with('ischeck',$ischeck);
                return view('pages.home.homenew')->with('all_product',$all_product)->with('related_one',$related_one)->with('ischeck',$ischeck)->with('related_two',$related_two);       
                }
                else{
                $ischeck = 0;
                return view('pages.home.homenew')->with('all_product',$all_product)->with('ischeck',$ischeck);
                }

            }else{
                $ischeck = 0;
                return view('pages.home.homenew')->with('all_product',$all_product)->with('ischeck',$ischeck);
            }
    	
    }
    public function search(Request $request){

        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
        //--seo
        $keywords = $request->keywords_submit;

        $search_product = Product::where('product_name','like','%'.$keywords.'%')->paginate(6); 

        return view('pages.sanpham.search')->with('search_product',$search_product);

    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;position:relative">';
            foreach ($product as $key => $val) {
                $output.='
                <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>';
            }
            $output .='</ul>';
            echo $output;
        }
    }
}
