@extends('layoutnew')
@section('content')
<div class="features_items"><!--features_items-->
                        <h3 class="text-dark font-weight-bold text-center">Kết quả tìm kiếm</h3>
                       @foreach($search_product as $key => $product)
                        <div class="col-lg-4">
                                <form>
                                 @csrf
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
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
                                        <p class="card-text text-center">{{$product->product_name}}</p>
                                        <button type="button" class="btn btn-light button-card add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Mua ngay</button>
                                        <button type="button" data-toggle="modal" data-target="#xemnhanh" class="btn btn-light button-card xemnhanh" data-id_product="{{$product->product_id}}" name="add-to-cart">Xem ngay</button>
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
                   
                    <div style="text-align: center" >
                   {{$search_product->links()}}
                   </div><!--features_items--> 
        <!--/recommended_items-->
@endsection