<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use Excel;
use App\Category;
use App\Brand;
use App\Product;
use App\Post;
use App\CategoryPost;
use App\Advertisement;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{

    public function add_category_product(){
        
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        
    	$all_category_product = Category::all();
    	$manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);


    }
    public function save_category_product(Request $request){
         $this->validate($request,
        [
            'category_product_name' => 'required|unique:tbl_category_product,category_name',
        ],
        [
            'category_product_name.unique'=>'Tên danh mục đã tồn tại',
        ]);
        $data = $request->all();
    	$category = new Category;

    	$category->category_name = $request->category_product_name;
        $category->meta_keywords = $request->category_product_keywords;
        $category->slug_category_product = str_slug($request->category_product_name);
    	$category->category_desc = $request->category_product_desc;
    	$category->category_status = $request->category_product_status;

    	$category->save();
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id){
        
        Category::where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        
        Category::where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        
        $edit_category_product = Category::where('category_id',$category_product_id)->get();

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request->category_product_desc;
        Category::where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        
        Category::where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home(Request $request ,$slug_category_product){
       //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_post = CategoryPost::where('cate_post_status','0') ->orderby('cate_post_id','desc')->take(8)->get();
        $cate_product = Category::where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $adv = Advertisement::where('adv_status','1')->get();
        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);
        $cate = Category::where('slug_category_product',$slug_category_product)->first();
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price = $max_price + 1000000;
        $quangcaohome =0;
        // $category_by_id = Product::where('category_id',$cate['category_id'])->paginate(6);
        $category_name = Category::where('slug_category_product',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
                //seo 
                $meta_desc = $val->category_desc; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $url_canonical = $request->url();
                //--seo
                }
         if(isset($_GET['filter_by'])){
            $filter_by = $_GET['filter_by'];
            if($filter_by =='giam_dan'){
                $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->orderBy('product_price','DESC')->paginate(12)->appends(request()->query());
            }elseif($filter_by =='tang_dan'){
                 $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->orderBy('product_price','ASC')->paginate(12)->appends(request()->query());
            }
            elseif($filter_by =='za'){
                 $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->orderBy('product_name','DESC')->paginate(12)->appends(request()->query());
            }
            elseif($filter_by =='az'){
                $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->orderBy('product_name','ASC')->paginate(12)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->whereBetween('product_price',[$min,$max])->orderBy('product_id','ASC')->paginate(12)->appends(request()->query());
        }
        else{
                $category_by_id = Product::with('danhmuc')->where('category_id',$cate['category_id'])->paginate(12)->appends(request()->query());
            }
        
        

        return view('pages.category.show_categorynew')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('cate_post',$cate_post)->with('slider',$slider)->with('cate_post',$cate_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('adv',$adv)->with('quangcaohome',$quangcaohome);
    }
    // public function export_csv(){
    //     return Excel::download(new ExcelExports , 'category_product.xlsx');
    // }
    // public function import_csv(Request $request){
    //     $path = $request->file('file')->getRealPath();
    //     Excel::import(new ExcelImports, $path);
    //     return back();
    // }
  

}
