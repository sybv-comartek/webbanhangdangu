<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use Session;
use App\Slider;
use App\Product;
use App\Category;
use App\Brand;
use App\Customer;
use App\Post;
use App\CategoryPost;
use App\Advertisement;
use App\Recommend\Recommend;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();
class PostController extends Controller
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
        $quangcaohome = 0;
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
    public function add_post(){

        $cate_post = CategoryPost::orderBy('cate_post_id','desc')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));

    }
    public function save_post(Request $request){
        $this->validate($request,
        [
            'post_title' => 'required|unique:tbl_post,post_title',
            'post_image' => 'image|mimes:jpg,jpeg,png',
            'post_image_adv' => 'image|mimes:jpg,jpeg,png'
        ],
        [
            'post_title.unique'=>'Tên sản phẩm đã tồn tại',
            'post_image.mimes'=>'Chỉ tải lên được file ảnh',
            'post_image_adv.mimes'=>'Chỉ tải lên được file ảnh'
        ]);
    	$data = $request->all();
    	$post = new Post();

    	$post->post_title= $data['post_title'] ;

        $post->post_slug = str_slug($data['post_title']);
        $post->post_author= $data['post_author'];
    	$post->post_meta_desc = $data['post_meta_desc']  ;
    	$post->post_meta_keyword = $data['post_meta_keyword']  ;
        $post->post_content = $data['post_content']  ;
        $post->post_status = $data['post_status']  ;
        $post->post_desc = $data['post_desc'] ;
        $post->cate_post_id = $data['cate_post_id'] ;
        // $data['product_image'] = $request->product_status;
        $get_image = $request->file('post_image');
        $get_image_adv = $request->file('post_image_adv');

        if($get_image){
            if($get_image_adv){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;

            $get_name_image_adv = $get_image_adv->getClientOriginalName();
            $name_image_adv = current(explode('.',$get_name_image_adv));
            $new_image_adv =  $name_image_adv.rand(0,99).'.'.$get_image_adv->getClientOriginalExtension();
            $get_image_adv->move('public/uploads/adv',$new_image_adv);

            $post->post_image_adv = $new_image_adv;

            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return redirect()->back();
            }
            else{
            Session::put('message','Thêm thất bại. Vui lòng thêm ảnh');
            return redirect()->back();
                }
        }
        else{
        Session::put('message','Thêm thất bại. Vui lòng thêm ảnh');
    	return redirect()->back();
        }
    }
       public function all_post(){
        
    	 $all_post = Post::orderBy('post_id','DESC')->paginate(10);
    	
    	return view('admin.post.list_post')->with(compact('all_post'));


    }

    public function delete_post($post_id){
      
        $post = Post::find($post_id);
        $post_image =$post->post_image;
        unlink('public/uploads/post/'.$post_image);
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return Redirect::to('all-post');
    }

 	public function show_post(Request $request, $post_slug){
 		$cate_post_home = CategoryPost::where('cate_post_slug',$post_slug)->take(1)->get();

 		foreach ($cate_post_home as $key => $cate_h) {

 				$meta_desc = $cate_h->cate_post_desc;

                $meta_keywords = $cate_h->cate_post_slug;

                $meta_title = $cate_h->cate_post_name;

                $url_canonical = $request->url();

                $cate_id = $cate_h->cate_post_id;
                $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
                
 		}
 		 $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(10);
 		return view('pages.post.danhmucbaiviet')->with(compact('post'));
 	}
 	public function post_detail(Request $request,$post_slug){

 		$post_detail = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();
 		

 		foreach ($post_detail as $key => $po) {

 				$meta_desc = $po->post_desc;

                $meta_keywords = $po->post_slug;

                $meta_title = $po->post_title;

                $url_canonical = $request->url();

                $cate_post_id = $po->cate_post_id;
                $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
            
 		}
 		$related_post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_post_id)->whereNotIn('post_slug',[$post_slug])->take(6)->get();
 		return view('pages.post.baivietnew')->with(compact('post_detail','related_post'));
 	}
}