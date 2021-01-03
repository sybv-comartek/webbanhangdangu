@extends('layoutnew')
@section('content')
                        @foreach($category_name as $key => $name)
                        <h3 class="text-dark font-weight-bold text-center">{{$name->category_name}}</h3>
                        @endforeach
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="amount">Sắp xếp theo</label>
                                <form>
                                    @csrf
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="{{ Request::url()}}?filter_by=none">---Lọc---</option>
                                        <option value="{{ Request::url()}}?filter_by=tang_dan">Giá tăng dần</option>
                                        <option value="{{ Request::url()}}?filter_by=giam_dan">Giảm giảm dần</option>
                                        <option value="{{ Request::url()}}?filter_by=az">A đến Z</option>
                                        <option value="{{ Request::url()}}?filter_by=za">Z đến A</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-sm-8">
                            </div>
                             {{-- <div class="col-sm-4">
                                <label for="amount">Lọc giá</label>
                                <form>
                                    <div id="slider-range"></div>
                                     <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                     <input type="hidden" id="start_price" name="start_price">
                                     <input type="hidden" id="end_price" name="end_price">
                                     <input  type="submit" name="filter_money" value="Lọc giá" class="btn btn-sm btn-default bg-dark w-10">
                                </form>
                            </div>
                        </div>  --}}
                        <div class="row d-flex justify-content-around w-100">
                        	@foreach($category_by_id as $key => $product)
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
                            
                        </div>
                        
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
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bg-dark" data-dismiss="modal">Đóng</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- phan trang --}}
                    <div style="text-align: center" >
                   {{$category_by_id->links()}}
                   </div>
 @endsection