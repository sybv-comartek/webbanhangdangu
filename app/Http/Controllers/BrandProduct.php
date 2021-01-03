<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Product;
use App\Category;
use App\Slider;
use App\Post;
use App\CategoryPost;
use App\Advertisement;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{

    public function add_brand_product(){

    	return view('admin.add_brand_product');
    }
    public function all_brand_product(){

        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
    	$manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);


    }
    public function save_brand_product(Request $request){
         $this->validate($request,
        [
            'brand_product_name' => 'required|unique:tbl_brand,brand_name',
        ],
        [
            'brand_product_name.unique'=>'Tên thương hiệu đã tồn tại',
        ]);
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = str_slug($request->category_product_name);
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
       
    	// $data = array();
    	// $data['brand_name'] = $request->brand_product_name;
        // $data['brand_slug'] = $request->brand_slug;
    	// $data['brand_desc'] = $request->brand_product_desc;
    	// $data['brand_status'] = $request->brand_product_status;
    	// DB::table('tbl_brand')->insert($data);
        
    	Session::put('message','Thêm thương hiệu sản phẩm thành công');
    	return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){

        Brand::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
       
        Brand::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function edit_brand_product($brand_product_id){
        

        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        
        Brand::where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page
     
     public function show_brand_home(Request $request, $brand_slug){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $adv = Advertisement::where('adv_status','1')->get();
        $quangcaohome =0;
        $cate_product = Category::where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
        $cate_post = CategoryPost::where('cate_post_status','0') ->orderby('cate_post_id','desc')->take(8)->get();
        $bra = Brand::where('brand_slug',$brand_slug)->first();
        // $brand_by_id = Product::where('brand_id',$bra['brand_id'])->paginate(6);
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price = $max_price + 1000000;
        $brand_name = Brand::where('brand_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }
         
          if(isset($_GET['filter_by'])){
            $filter_by = $_GET['filter_by'];
            if($filter_by =='giam_dan'){
                $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());
            }elseif($filter_by =='tang_dan'){
                 $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }
            elseif($filter_by =='za'){
                 $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->orderBy('product_name','DESC')->paginate(12)->appends(request()->query());
            }
            elseif($filter_by =='az'){
                $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->orderBy('product_name','ASC')->paginate(12)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->whereBetween('product_price',[$min,$max])->orderBy('product_id','ASC')->paginate(12)->appends(request()->query());
        }
        else{
                $brand_by_id = Product::with('thuonghieu')->where('brand_id',$bra['brand_id'])->paginate(12)->appends(request()->query());
            }
        return view('pages.brand.show_brandnew')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('cate_post',$cate_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('adv',$adv)->with('quangcaohome',$quangcaohome);
    }
}
