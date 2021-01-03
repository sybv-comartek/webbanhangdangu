@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
						{{-- <div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div> --}}
							{{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">

										<div class="item active">
										  <a href=""><img src="{{URL::to('public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										
										
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> --}}
							<style type="text/css">
								.lSSlideOuter .lSPager .lSGallery img{
									display: block;
									height: 140px;
									max-width: 100%;
								}
								li.active {
									border: 2px solid;
								}
							</style>
							<div class="col-sm-5">
							<ul id="imageGallery">
								@foreach($gallery_product as $key=>$gal)
							  <li data-thumb="{{asset('/public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('/public/uploads/gallery/'.$gal->gallery_image)}}">
							    <img width="50%" src="{{asset('/public/uploads/gallery/'.$gal->gallery_image)}}}}" />
							  	@endforeach

							</ul>
							<div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Mã ID: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									@csrf
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                          
								<span>
									<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
								
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
								</span>
								<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới 100%</p>
								<p><b>Thương hiệu:</b> {{$value->thuonghieu->brand_name}}</p>
								<p><b>Danh mục:</b> {{$value->danhmuc->category_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
							
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p style="text-decoration-color: #FFFFFF">{!!$value->product_desc!!}</p>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
								
						
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									@if(Auth::check())
					                <div class="well">
					                    {{-- @include('admin.notice') --}}
					                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
					                    <form action="{{URL::to('rating/'.$value->product_id)}}" role="form" method="POST">
					                        {{csrf_field()}}
					                        <div class="fa fa-star" style="color: #ff9705">
					                        	<input type="number" id="rating_number" name="rating_number" min="1" max="5">
					                        </div>
					                        <div class="form-group">
					                            <textarea name="NoiDung" id="NoiDung" class="form-control animated" cols="50"  placeholder="Enter your review here..." rows="5" rows="2"></textarea>
					                        </div>
					                        <div class="form-group">
					                        
					                        <button name="comment" id="comment" type="submit" class="btn btn-primary">Gửi</button>

					                    </form>
					                </div>
					                @else
					                <h3 style="text-align: center;">Đăng nhập để đánh giá sản phẩm !!!</h3>
					                @endif
					                <hr>

					                <!-- Posted Comments -->

					                <!-- Comment -->
					                <h3>Đánh giá sản phẩm</h3>
					                @foreach($rating_product as $cm)
					                <div  id="NoiDung" class="media">
					                    <a class="pull-left" href="#">
					                        <span class="fa fa-star" style="color: #ff9705">{{$cm->rating}}</span>
					                    </a>
					                    <div class="media-body">
					                        <h4 class="media-heading">{{$cm->customer_name}}
					                            <small>{{$cm->created_at}}</small>
					                       
					                        </h4>
					                        {{$cm->comment}}
					                    </div>
					                </div>
					                @endforeach

					            </div>
																		
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach		
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($relate as $key=>$product)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center">
		                                        	<form>
                                                	@csrf
		                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
		                                            <input id="name_pro" type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
		                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
		                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
		                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

		                                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
		                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
		                                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
		                                                <p>{{$product->product_name}}</p>

		                                             
		                                             </a>
		                                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            		</form>
		                                            {{-- <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
		                                            <h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
		                                            <p>{!! $lienquan->product_name !!}</p>
		                                            <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> --}}
		                                        </div>
		                                       
                                			</div>
										</div>
									</div>
							@endforeach		
								</div>
									
							</div>
									
						</div>
					</div>
					<div style="text-align: center" >
                   {{$relate->links()}}
                   </div>

@endsection
