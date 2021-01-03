@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

                        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        @foreach($all_product as $key => $product)
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
                                             <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
                                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                                <p>{{$product->product_name}}</p>

                                             
                                             </a>
                                             <div>
                                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            <input style="position: relative;top: -13px;" type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh"  data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            </div>
                                            </form>

                                        </div>
                                      
                                </div>
                           
                               {{--  <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->
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
                                        h5.modal-title.product_quickview_title{
                                            text-align: center;
                                            font-size: 25px;
                                            color: brown;
                                        }
                                        p.quickview{
                                            font-size: 25px;
                                            color: brown;  
                                        }
                                        span#product_quickview_content img{
                                            width: 100%;
                                        }
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
                                    </style>
                                    <h4 class="quickview"><span id="product_quickview_title"></span></h4>
                                    <p style="font-size: 20px"> Mã ID : <span id="product_quickview_id"></span></p>
                                    <span>
                                        <h2 style="font-size: 20px">Giá sản phẩm : <span id="product_quickview_price"></span></h2><br/>
                                        <p style="font-size: 20px">Số lượng : </p>
                                        <input style="width: 30% ; height: 40px" type="number" name="qty" min="1" class="cart_product_qty_" value="1">
                                       {{--  <input type="hidden" name="productid_hidden" value=""> --}}
                                    </span><br/>
                                    <p style="margin-top: 30px" class="quickview">Mô tả sản phẩm</p>
                                    <fieldset style="margin-top: 30px">
                                        <span style="width: 100%;font-size: 15px" id="product_quickview_desc"></span>
                                         <span style="width: 100%;font-size: 15px" id="product_quickview_content"></span>
                                    </fieldset>
                                    <input type="button" style="margin-left: 100px;height: 30px;width: 150px;margin-top: 50px;"  value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview"  name="add-to-cart" data-id_product="{{$product->product_id}}">
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
                    <div style="text-align: center" >
                   {{$all_product->links()}}
                   </div>
                   <hr>
                   <hr>
        <!--/recommended_items-->
        @if(Auth::check() && $ischeck==1)
        {{-- <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Gợi ý riêng cho bạn</h2>
                        
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                
                            </div>         
                        </div>
                    </div><!--/recommended_items--> --}}
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Gợi ý dành riêng cho bạn</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                @foreach($related_one as $key=>$product)   
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="item">
                                @foreach($related_two as $ke=>$produc)  
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <form>
                                                    @csrf
                                                    <input type="hidden" value="{{$produc->product_id}}" class="cart_product_id_{{$produc->product_id}}">
                                                    <input id="name_pro" type="hidden" value="{{$produc->product_name}}" class="cart_product_name_{{$produc->product_id}}">
                                                    <input type="hidden" value="{{$produc->product_image}}" class="cart_product_image_{{$produc->product_id}}">
                                                    <input type="hidden" value="{{$produc->product_price}}" class="cart_product_price_{{$produc->product_id}}">
                                                    <input type="hidden" value="1" class="cart_product_qty_{{$produc->product_id}}">

                                                    <a href="{{URL::to('/chi-tiet/'.$produc->product_slug)}}">
                                                        <img src="{{URL::to('public/uploads/product/'.$produc->product_image)}}" alt="" />
                                                        <h2>{{number_format($produc->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                                        <p>{{$produc->product_name}}</p>

                                                     
                                                     </a>
                                                    <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->            
                @endif
@endsection