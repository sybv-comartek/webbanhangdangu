@extends('layoutnew')
@section('content')
                    <div>
                        <h5 class="text-dark font-weight-bold text-center">SẢN PHẨM MỚI NHẤT</h5>

                        <div class="row d-flex justify-content-around">
                        	@foreach($all_product as $key => $product)
                            <div class="col-lg-4">
                            	<form>
                                 @csrf
                                <div class="card-boder mt-4 w-100">
                                	 <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                     <input id="name_pro" type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                     <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                     <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                     <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                     <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                                    <div class="image-border mt-3 w-100" style="text-align: center;">
                                        <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}"><img style="width: 100px; height: 100px;" class="card-img-top mt-3" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="Card image cap"></a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h5>
                                        {{-- <p class="card-text text-center">{{$product->product_name}}</p> --}}
                                        
                                            
                                                @if(strlen($product->product_name)<=30){

                                                   <p class="card-text text-center"> {{$product->product_name}} </p>
                                                @else
                                                @php
                                                    $product->product_name= mb_substr($product->product_name,0,27,'UTF-8').'...';
                                                @endphp
                                                     <p class="card-text text-center"> {{$product->product_name}} </p>
                                                @endif
                                        <button type="button" class="btn btn-light button-card add-to-cart border" data-id_product="{{$product->product_id}}" name="add-to-cart">Mua ngay</button>
                                        <button type="button" data-toggle="modal" data-target="#xemnhanh" class="btn btn-light button-card xemnhanh border" data-id_product="{{$product->product_id}}" name="add-to-cart">Xem ngay</button>
                                    </div>
                                </div>
                            	</form>
                            </div>
                            @endforeach
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
                                    <span id = "product_quickview_gallery"></span>
                                </div>
                                <form>
                                    @csrf
                                    <div id="product_quickview_value"></div>
                                <div class="col-md-7">
                                    <style type="text/css">
                                        /*h5.modal-title.product_quickview_title{
                                            text-align: center;
                                            font-size: 25px;
                                            color: black;
                                        }
                                        p.quickview{
                                            font-size: 25px;
                                            color: black;  
                                        }
                                        span#product_quickview_content img{
                                            width: 100%;
                                        }
                                        <style>*/
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
                                    {{-- </style> --}}
                                    </style>

                                    {{-- <div class="col-lg-6">
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
                                    </div>
                                    </div> --}}

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
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- phan trang --}}
                    <div class="w-100" style="text-align: center ; color: black" >
                   {{$all_product->links()}}
                   </div>


                   {{-- recommender --}}
                  @if(Auth::check() && $ischeck==1)
                        <section class="home-section">
                            <h5 class="text-dark font-weight-bold text-center">GỢI Ý DÀNH RIÊNG CHO BẠN</h5>
                            <div class="row d-flex justify-content-around">
                                {{-- end --}}
                            @foreach($related_one as $key=>$product)  
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
	                                        <button type="button" class="btn btn-light button-card add-to-cart border" data-id_product="{{$product->product_id}}" name="add-to-cart">Mua ngay</button>
	                                        <button type="button" data-toggle="modal" data-target="#xemnhanh" class="btn btn-light button-card xemnhanh border" data-id_product="{{$product->product_id}}" name="add-to-cart">Xem ngay</button>
	                                    </div>
	                                </div>
	                            	</form>
                                </div>
                            @endforeach
                              
                            </div>
                         </section>
                    @endif
@endsection
