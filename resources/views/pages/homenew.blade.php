@extends('layoutnew')
@section('content')

                        <h5 class="text-dark font-weight-bold text-center">SẢN PHẨM MỚI NHẤT</h5>

                        <div class="row d-flex justify-content-around">
                        	@foreach($all_product as $key => $product)
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
                            {{-- <div class="col-lg-4">
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                        <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                        <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                        <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                        <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                        <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                        <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                        <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                        <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                        <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                        <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                        <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                        <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                    <div class="image-border mx-auto d-block mt-3">
                                        <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                        <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                        <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                        <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <nav  aria-label="Page navigation example text-center">
                            <ul class="pagination justify-content-center">
                              <li class="page-item disabled">
                                <a class="page-link text-dark" href="#" tabindex="-1">Previous</a>
                              </li>
                              <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                              <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                              <li class="page-item">
                                <a class="page-link text-dark" href="#">Next</a>
                              </li>
                            </ul>
                        </nav> --}}
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
                                            color: black;
                                        }
                                        p.quickview{
                                            font-size: 25px;
                                            color: black;  
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
                                        <h4 style="">Giá sản phẩm : <span id="product_quickview_price"></span></h4><br/>
                                        <p style="font-size: 20px">Số lượng : </p>
                                        <input style="width: 30% ; height: 40px" type="number" name="qty" min="1" class="cart_product_qty_" value="1">
                                       {{--  <input type="hidden" name="productid_hidden" value=""> --}}
                                    </span><br/>
                                    <p style="margin-top: 30px" class="quickview">Mô tả sản phẩm</p>
                                    <fieldset style="margin-top: 30px">
                                        <p style="width: 100%;font-size: 15px" id="product_quickview_desc"></p>
                                         <p style="width: 100%;font-size: 15px" id="product_quickview_content"></p>
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
                    <div style="text-align: center ; color: black" >
                   {{$all_product->links()}}
                   </div>


                   {{-- recommender --}}
                  @if(Auth::check() && $ischeck==1)
                        <section class="home-section">
                            <h5 class="text-dark font-weight-bold text-center">GỢI Ý DÀNH RIÊNG CHO BẠN</h5>
                            <div class="row d-flex justify-content-around">
                            @foreach($related_one as $key=>$product)  
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
                               {{--  <div class="col-lg-4">
                                    <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                            <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                            <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                            <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                            <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                            <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                            <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                            <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                            <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                            <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                            <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                            <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                            <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-boder mt-4 bg-white" style="width: 16rem;">
                                        <div class="image-border mx-auto d-block mt-3">
                                            <img class="card-img-top img-fluid w-50 mx-auto d-block mt-3" src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="ml-2 text-dark font-weight-bold text-center">1.500.000</h5>
                                            <p class="card-text text-center">Điện thoại Samsung Galaxy Note 8 4G LTE, samsung, 4G, Android</p>
                                            <button type="button" class="btn btn-light button-card">Mua ngay</button>
                                            <button type="button" class="btn btn-light button-card">Xem ngay</button>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                         </section>
                    @endif
@endsection
