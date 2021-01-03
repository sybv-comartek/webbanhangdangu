@extends('layout')
@section('content')
                    <div class="features_items"><!--features_items-->

                        <h2 class="title text-center">{{ $meta_title }}</h2>
                        @foreach($post_detail as $key => $po)
                      	 <div class="post-image-wrapper">
                           
                                <div class="single-products" style="margin: 10px 0;">
                                      {!! $po->post_content !!}
                                      {!! $po->post_desc !!}
                                </div>
                           
                                
                            </div>
                        @endforeach
                    </div><!--features_items-->
                    <h2 class="title text-center">Bài viết liên quan</h2>
                    <ul>
                     @foreach($related_post as $ke => $re)
                         <div class="post-image-wrapper">
                           
                                <div class="single-products" style="margin: 10px 0;">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                         <a href="{{URL::to('/bai-viet/'.$re->post_slug)}}">
                                                <img style="float:left;width: 30%;padding: 5px;height: 150px" src="{{URL::to('public/uploads/post/'.$re->post_image)}}" alt="" />
                                                
                                                <h4 style="color: black ;padding:5px">{{$re->post_title}}</h4>
                                                <p>{!! $re->post_desc !!}</p>
                                             
                                             </a>
                                        <a href="{{URL::to('/bai-viet/'.$re->post_slug)}}" class="btn btn-warning btn-sm">Xem bài viết</a>
                                            </form>

                                        </div>
                                      
                                </div>
                           
                                
                            </div>
                        @endforeach
                        </ul>
                   <hr>

@endsection