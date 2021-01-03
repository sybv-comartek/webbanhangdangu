@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm bài viết
                        </header>
                        @include('pages.notice.notice')
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục bài viết</label>
                                      <select name="cate_post_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_post as $key => $cate)
                                            <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" name="post_title" value="{{ old('post_title') }}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tác giả</label>
                                    <input type="text" name="post_author" value="" class="form-control" placeholder="Tên tác giả">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="brand_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="post_desc" id="ckeditor" placeholder="Tóm tắt bài viết"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="post_content" id="ckeditor1" placeholder="Nội dung bài viết"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa sell</label>
                                     <input type="text" name="post_meta_keyword" class="form-control"  placeholder="Tên danh mục">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sell</label>
                                    <textarea style="resize: none" rows="3" class="form-control" name="post_meta_desc" id="exampleInputPassword1" placeholder="Nội dung bài viết"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="post_image" class="form-control" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Banner quảng cáo</label>
                                    <input type="file" name="post_image_adv" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="post_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển Thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm bài viết</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection