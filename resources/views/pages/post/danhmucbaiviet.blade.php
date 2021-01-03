@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

                        <h2 class="title text-center">{{ $meta_title }}</h2>
                        @foreach($post as $key => $po)
                      	 <div class="post-image-wrapper">
                           
                                <div class="single-products" style="margin: 10px 0;">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                         
                                            <a href="{{URL::to('/bai-viet/'.$po->post_slug)}}">
                                                <img style="float:left;width: 30%;padding: 5px;height: 150px" src="{{URL::to('public/uploads/post/'.$po->post_image)}}" alt="" />
                                                
                                                <h4 style="color: black ;padding:5px">{{$po->post_title}}</h4>
                                                <p>{!! $po->post_desc !!}</p>
                                             
                                             </a>
                                       	<a href="{{URL::to('/bai-viet/'.$po->post_slug)}}" class="btn btn-warning btn-sm">Xem bài viết</a>
                                            </form>

                                        </div>
                                      
                                </div>
                           
                                
                            </div>
                        @endforeach
                    </div><!--features_items-->
                    <div style="text-align: center" >
                   {{$post->links()}}
                   </div>
                   <hr>

@endsection