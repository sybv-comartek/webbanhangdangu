@extends('layoutnew')
@section('content')
@foreach($product_details as $key => $value)
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-boder-detail mt-4 px-0 ">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img style="width: 65%;" class="card-img-top img-fluid mx-auto d-block mt-3" src="{{asset('/public/uploads/product/'.$value->product_image)}}" alt="Card image cap">
                                    </div>
                                </div>
                                <div class="container mt-3 float-left">
                                	@foreach($gallery_product as $key=>$gal)
                                    <section class="customer-logos slider w-75">
                                    	
                                        <div class="slide mr-3"><img style="width: 50px;" src="{{asset('/public/uploads/gallery/'.$gal->gallery_image)}}"></div>
                                       
                                       {{--  <div class="slide mr-3"><img style="width: 50px;" src="./image/943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png"></div>
                                        <div class="slide mr-3"><img style="width: 50px;" src="./image/943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png"></div>
                                        <div class="slide mr-3"><img style="width: 50px;" src="./image/943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png"></div>
                                        <div class="slide mr-3"><img style="width: 50px;" src="./image/943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png"></div>
                                        <div class="slide mr-3"><img style="width: 50px;" src="./image/943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png"></div> --}}
                                    </section>
                                     @endforeach
                                    <h5 class="mt-4">
                                        ĐÁNH GIÁ SẢN PHẨM
                                    </h5>
                                    <ul class="list-inline" title="Average Rating">
                                                @for($count=1;$count<=$rating_tb;$count++)
                                                    @php
                                                        if($count <=$rating_tb){
                                                            $color = 'color:#ffcc00;';
                                                        }else{
                                                            $color = 'color:#ccc;';
                                                        }
                                                    @endphp
                                                <li title="đánh giá sao" 
                                                id="{{ $value->product_id }}-{{$count}}"
                                                data-index="{{$count}}" 
                                                data-product_id="{{ $value->product_id }}"
                                                data-rating="{{ $rating_tb }}"
                                                class="rating"
                                                style=" {{ $color }}; font-size: 25px" 
                                                >
                                                  &#9733;  
                                                </li>
                                                @endfor
                                                @if($rating_tb==0)
                                                    Chưa có đánh giá
                                                
                                                @else
                                                {{ $rating_tb}}/5 sao
                                                @endif
                                            </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-5 px-0">
                                	<form action="{{URL::to('/save-cart')}}" method="POST">
									@csrf
											<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                            <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
	                                    <h5>
	                                        {{$value->product_name}} 
	                                    </h5>
	                                    <p>
	                                        Mã ID: {{$value->product_id}}
	                                    </p>
	                                    <h4>
	                                        {{number_format($value->product_price,0,',','.').'VNĐ'}}
	                                    </h4>
	                                    <p>
	                                        Số lượng: <input style="width: 10%" name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
										<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
	                                    </p>
	                                    <p>
	                                        Mô tả: {!!$value->product_content!!}
	                                    </p>
	                                    <button data-id_product="{{$value->product_id}}" name="add-to-cart" type="button w-100" class="btn btn-dark add-to-cart">Thêm vào giỏ hàng</button>
                                	</form>
                                    <br>
                                </div>
                            </div>
                        </div>


                        {{-- danh gia --}}
                        @if(Auth::check())
					                <div class="well">
					                    {{-- @include('admin.notice') --}}
					                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
					                    <form action="{{URL::to('rating/'.$value->product_id)}}" role="form" method="POST">
					                        {{csrf_field()}}
					                        {{-- <div class="fa fa-star" style="color: #ff9705">
					                        	<input type="number" id="rating_number" name="rating_number" min="1" max="5">
					                        </div> --}}
                                            {{-- <ul class="list-inline" title="Average Rating">
                                                @for($count=1;$count<=5;$count++)
                                                    @php
                                                        if($count <=$rating_tb){
                                                            $color = 'color:#ffcc00;';
                                                        }else{
                                                            $color = 'color:#ccc;';
                                                        }
                                                    @endphp
                                                <li title="đánh giá sao" 
                                                id="{{ $value->product_id }}-{{$count}}"
                                                data-index="{{$count}}" 
                                                data-product_id="{{ $value->product_id }}"
                                                data-rating="{{ $rating_tb }}"
                                                class="rating"
                                                style=" cursor: pointer; {{ $color }}; font-size: 25px" 
                                                >
                                                  &#9733;  
                                                </li>
                                                @endfor
                                                
                                            </ul> --}}
                                            <div class="rate">
                                                <input type="radio" id="star5" name="rating_number" value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" name="rating_number" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" name="rating_number" value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" name="rating_number" value="2" />
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" name="rating_number" value="1" />
                                                <label for="star1" title="text">1 star</label>
                                              </div
                                            
					                        <div class="form-group">
					                            <textarea name="NoiDung" id="NoiDung" class="form-control animated" cols="50"  placeholder="Enter your review here..." rows="5" rows="2"></textarea>
					                        </div>
					                        <div class="form-group">
					                        
					                        <button name="comment" id="comment" type="submit" class="btn btn-primary">Gửi</button>

					                    </form>
					                </div>
                        @else
                        <div class="container-fluid">
                            <h5 class="mt-3 text-center">
                                Vui lòng đăng nhập để đánh giá sản phẩm!
                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{URL::to('/dang-nhap')}}"><button type="button" class="btn btn-dark">Đăng nhập</button></a>
                            </div>
                        </div>
                        @endif

                        {{-- hien binh luan --}}

                        <div class="container-fluid">
                        	@foreach($rating_product as $cm)
                            <div class="row">
                                <div style="width: 60px;height: 60px;background-color: #C4C4C4;" class="rounded-circle"></div>
                                <div class="ml-2">
                                    <p>{{$cm->customer_name}}     {{$cm->created_at}}</p>
                                    <div class="text-warning">
                                    	@php 
                                    		$rating = $cm->rating;
                                    	@endphp
                                    	@for($i=0;$i<$rating;$i++)
                                        <i class="fa fa-star">
                                        @endfor
                                    </div>
                                    <p class="mt-1">{{$cm->comment}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
@endforeach
               {{-- </div>
               </div> --}}
<section class="home-section">
                            <h5 class="text-dark font-weight-bold text-center">SẢN PHẨM LIÊN QUAN</h5>

                            <div class="row d-flex justify-content-around">
                                @foreach($relate as $key=>$product)
                                <div class="col-lg-4">
                                    <form>
                                     @csrf
                                    <div class="card-boder mt-4 bg-white w-100">
                                         <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                         <input id="name_pro" type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                         <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                         <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                         <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                         <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}"><img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="Card image cap"></a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h5>
                                            <p class="card-text text-center">
                                                 @if(strlen($product->product_name)<=30){

                                                   <p class="card-text text-center"> {{$product->product_name}} </p>
                                                @else
                                                @php
                                                    $product->product_name= mb_substr($product->product_name,0,27,'UTF-8').'...';
                                                @endphp
                                                     <p class="card-text text-center"> {{$product->product_name}} </p>
                                                @endif
                                            </p>
                                            <button type="button" class="btn btn-light button-card add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Mua ngay</button>
                                            <button type="button" data-toggle="modal" data-target="#xemnhanh" class="btn btn-light button-card xemnhanhc" data-id_product="{{$product->product_id}}" name="add-to-cart">Xem ngay</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
</section>
                    <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg " role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title product_quickview_title" id="">
                                <span id = "product_quickview_title"></span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <span id = "product_quickview_image"></span>
                                    <span  id = "product_quickview_gallery"></span>
                                </div>
                                <form>
                                    @csrf
                                    <div id="product_quickview_value"></div>
                                <div class="col-md-7">
                                    
                                        <style>
                                        @media screen and(min-width: 768px){
                                            .modal-dialog{
                                                width: 700px;
                                            }
                                            .modal-sm{
                                                width: 350px;
                                            }
                                        }
                                        @media screen and(min-width: 992px){
                                            .modal-lg{
                                                width: 1200px;
                                            }
                                        }
                                    </style>
                                    <h4 class="quickview "><span  id="product_quickview_title"></span></h4>
                                    <p class="float-left"> Mã sản phẩm : <span  id="product_quickview_id"></span></p>
                                    {{-- <span> --}}
                                        <h4 class="float-left" style=""> <span id="product_quickview_price"></span></h4>
                                        {{-- <p style="font-size: 20px">Số lượng : </p> --}}
                                        <p class="float-left">
                                        Số lượng: <input style="width: 20% " type="number" name="qty" min="1" class="cart_product_qty_" value="1">
                                        {{-- <input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" /> --}}
                                        </p>
                                        
                                       {{--  <input type="hidden" name="productid_hidden" value=""> --}}
                                    {{-- </span> --}}
                                    <p  class="quickview float-left">Mô tả :<span id="product_quickview_desc"></span></p>
                                    {{-- <fieldset style="margin-top: 30px">
                                        <p style="width: 100%;font-size: 15px" id="product_quickview_desc"></p>
                                         <p style="width: 100%;font-size: 15px" id="product_quickview_content"></p>
                                    </fieldset> --}}
                                    <input type="button" style=""  value="Mua ngay" class="btn bg-dark btn-dark btn-sm add-to-cart-quickview"  name="add-to-cart" data-id_product="{{$product->product_id}}">
                                    <div style="font-size: 15px" id="before_cart"></div>
                                
                                </div>
                                </form>
                            </div>
                          </div>
                          </div>



@endsection
