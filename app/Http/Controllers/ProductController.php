<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Rating;
use Session;
use App\Slider;
use App\Product;
use App\Category;
use App\Brand;
use App\Customer;
use App\Recommend\Recommend;
use App\Http\Requests;
use Auth;
use App\Post;
use App\Gallery;
use App\CategoryPost;
use App\Advertisement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();
class ProductController extends Controller
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
        View::share('adv',$adv);
        $quangcaohome = 0;
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
    public function add_product(){
        
        $cate_product = Category::orderby('category_id','desc')->get(); 
        $brand_product = Brand::orderby('brand_id','desc')->get(); 
       

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
    public function all_product(){
        
    	$all_product = Product::orderby('product_id','desc')->get();
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
        
        $this->validate($request,
        [
            'product_name' => 'required|unique:tbl_product,product_name',
            'product_image' => 'image|mimes:jpg,jpeg,png'
        ],
        [
            'product_name.unique'=>'Tên sản phẩm đã tồn tại',
            'product_image.mimes'=>'Chỉ tải lên được file ảnh'
        ]);
    	$data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = str_slug($request->product_name);
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        // $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            Product::insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
    	Product::insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        
        Product::where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        
        Product::where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        
        $cate_product = Category::orderby('category_id','desc')->get(); 
        $brand_product = Brand::orderby('brand_id','desc')->get(); 

        $edit_product = product::where('product_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
        
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = str_slug($request->product_name);
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    Product::where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        Product::where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        
        Product::where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_slug , Request $request){
         //slide
        // $details_product = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->where('tbl_product.product_slug',$product_slug)->get();
        $details_product = Product::where('product_slug',$product_slug)->get();
        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $id_product = $value->product_id;
            $product_name = $value->product_name;
                
                $meta_desc = $value->product_desc;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
                $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
                
            }

            $rating_product = Rating::where('product_id',$id_product)->get();

            $rating_t =  Rating::where('product_id',$id_product)->avg('rating');
            $rating_tb= round($rating_t);
            $related_product = Product::where('category_id',$category_id)->paginate(6);

            $gallery_product = Gallery::where('product_id',$id_product)->get();
            return view('pages.sanpham.show_detailsnew')->with('product_details',$details_product)->with('relate',$related_product)->with('rating_product',$rating_product)->with('gallery_product',$gallery_product)->with('rating_tb',$rating_tb);
             

    }

    public function rating_product($product_id,Request $request)
    {
        $product_id = $product_id;
        $product = Product::find($product_id);
        $product_slug= $product->product_slug;
        $rating_pro = new Rating;
        $rating_pro->product_id = $product_id;
        $rating_pro->product_name = $product->product_name;
        $rating_pro->customer_id = Auth::user()->id;
        $rating_pro->customer_name = Auth::user()->name;
        $rating_pro->comment = $request->NoiDung;
        $rating_pro->rating = $request->rating_number;
        $rating_pro->save();
        return Redirect::to('/chi-tiet/'.$product_slug.'/');
    }
    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery']='';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'].= '<p><img width="30%" src="./public/uploads/gallery/'.$gal->gallery_image.'"></p>';
        }
        $output['product_name']=$product->product_name;
        $output['product_id']=$product->product_id;
        $output['product_desc']=$product->product_desc;
        $output['product_content']=$product->product_content;
        $output['product_price']=number_format($product->product_price,0,',','.').'VND';
        $output['product_image']='<p><img width="100%" src="./public/uploads/product/'.$product->product_image.'"></p>';

        $output['product_quickview_value'] ='
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input id="name_pro" type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">
        ';
        echo json_encode($output);
        
    }
     public function quickviewc(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery']='';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'].= '<p><img width="30%" src="../public/uploads/gallery/'.$gal->gallery_image.'"></p>';
        }
        $output['product_name']=$product->product_name;
        $output['product_id']=$product->product_id;
        $output['product_desc']=$product->product_desc;
        $output['product_content']=$product->product_content;
        $output['product_price']=number_format($product->product_price,0,',','.').'VND';
        $output['product_image']='<p><img width="100%" src="../public/uploads/product/'.$product->product_image.'"></p>';

        $output['product_quickview_value'] ='
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input id="name_pro" type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">
        ';
        echo json_encode($output);
        
    }

}
