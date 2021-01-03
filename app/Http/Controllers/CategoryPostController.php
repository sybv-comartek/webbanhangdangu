<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use App\Category;
use App\Brand;
use App\Product;
use App\CategoryPost;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPostController extends Controller
{

	public function add_category_post(){
        
    	return view('admin.categorypost.add_category_post');
    }
    public function all_category_post(){
        
    	 $all_category_post = CategoryPost::orderBy('cate_post_id','DESC')->paginate(5);
    	
    	return view('admin.categorypost.list_category_post')->with(compact('all_category_post'));


    }
    public function save_category_post(Request $request){
         $this->validate($request,
        [
            'cate_post_name' => 'required|unique:tbl_category_post,cate_post_name',
        ],
        [
            'cate_post_name.unique'=>'Tên danh mục đã tồn tại',
        ]);
        $data = $request->all();
    	$post = new CategoryPost();

    	$post->cate_post_name = $data['cate_post_name'];
        $post->cate_post_slug = str_slug($data['cate_post_name']);
        $post->cate_post_status = $data['cate_post_status'];
    	$post->cate_post_desc = $data['cate_post_desc'];
    	
    	$post->save();
    	Session::put('message','Thêm danh mục bài viết thành công');
    	return redirect()->back();

    }
  
    public function edit_category_post($cate_post_id){
        
        $edit_category_post = CategoryPost::where('cate_post_id',$cate_post_id)->get();

        return view('admin.categorypost.edit_category_post')->with(compact('edit_category_post'));
    }
    public function update_category_post(Request $request,$cate_post_id){
       
        $data = $request->all();
    	$post = CategoryPost::find($cate_post_id);
    	$post->cate_post_name = $data['cate_post_name'];
        $post->cate_post_slug = str_slug($data['cate_post_name']);
        $post->cate_post_status = $data['cate_post_status'];
    	$post->cate_post_desc = $data['cate_post_desc'];
    	$post->save();
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return Redirect()->back();
    }
    public function delete_category_post($cate_post_id){
        
        CategoryPost::where('cate_post_id',$cate_post_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect()->back();
    }
 public function add_post(){

        // $cate_post = CategoryPost::orderBy('cate_post_id','DESC')->get();

        return view('admin.categorypost.add_post');

    }

}