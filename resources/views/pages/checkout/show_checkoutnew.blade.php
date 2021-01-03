@extends('layoutnew')
@section('content')
 <section class="home-section">
            <div class="container">
                <h4 class="text-center"><a class="text-dark" href="#">Thanh toán giỏ hàng</a></h4>
               {{--  <p class="text-center mt-3" style="background-color: #EFEDED;"><i>FREESHPING VỚI HÓA ĐƠN TỪ 80K</i></p> --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="card-boder-checkoutcart mt-4 px-0">
                                <div>
                                    <h4 class="m-3"><a class="text-dark" href="#">Thanh toán giỏ hàng</a></h4>
                                    
                                    	@csrf
                                        <div class="">
                                          <div class="col mt-3">
                                            <input type="text" name="shipping_name"  class="form-control shipping_name" placeholder="Họ và tên">
                                          </div>
                                          <div class="col mt-3">
                                            <input type="text"  name="shipping_phone"  class="form-control shipping_phone" placeholder="Số điện thoại">
                                          </div>
                                          <div class="col mt-3">
                                            <input name="shipping_email" type="text" class="form-control shipping_email" placeholder="Email">
                                          </div>
                                          <div class="col mt-3">
                                            <input type="text" name="shipping_address" class="form-control shipping_address" placeholder="Địa chỉ cụ thể">
                                          </div>
                                          <div class="col mt-3">
                                            <input type="text" name="shipping_notes" class="form-control shipping_notes" placeholder="Ghi chú">
                                          </div>
                                          @if(Session::get('fee'))
											<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
											@else 
												<input type="hidden" name="order_fee" class="order_fee" value="30000">
											@endif
                                            {{-- <input type="hidden" name="order_fee" id="feeshi" class="order_fee" value=""> --}}

											@if(Session::get('coupon'))
												@foreach(Session::get('coupon') as $key => $cou)
													<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
												@endforeach
											@else 
												<input type="hidden" name="order_coupon" class="order_coupon" value="no">
										   @endif
										  <form method="POST">
                                            @csrf
                                          <div class="col mt-3">
                                           <select name="city" id="city" class="custom-select choose city" >
                                                    <option selected>--Chọn thành phố--</option>
                                                     @foreach($city as $key => $ci)
                                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                    @endforeach
                                                    
                                            </select>
                                          </div>
                                          <div class="row">
                                            <div class="col m-3">
                                                <select name="province" id="province" class="custom-select province choose">
                                                    <option value="">--Chọn quận huyện--</option>
                                                </select>
                                            </div>
                                            <div class="col m-3">
                                                <select name="wards" id="wards" class="custom-select wards">
                                                    <option value="">--Chọn xã phường--</option>
                                                  </select>
                                            </div>
                                          </div>
                                        </form>
                                    <form method="POST">
                                          <h5 class="m-3"><a class="text-dark" href="#">PHƯƠNG THỨC THANH TOÁN</a></h5>
                                          <div class="col mt-3 mb-5">
                                            <div class="">
                                                <div class="form-group">
                                                   <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                                     <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
                                                           <option value="0">Qua tài khoản</option>
		                                            	   <option value="1">Thanh toán khi nhận hàng</option>  
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="d-flex justify-content-center">
	                                        <input type="button" name="send_order" value="HOÀN TẤT ĐẶT HÀNG" class="btn btn-dark mb-3 w-50 send_order">
	                                       </div>
                                        </div>
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <div class="card-boder-checkoutcart mt-4 px-0">
                                <h4 class="m-3"><a class="text-dark" href="#">ĐƠN HÀNG</a></h4>
                                @if(Session::get('cart')==true)
									@php
											$total = 0;
									@endphp
								@foreach(Session::get('cart') as $key => $cart)
										@php
											$subtotal = $cart['product_price']*$cart['product_qty'];
											$total+=$subtotal;
									@endphp
                                <div>
                                    <div class="row d-flex justify-content-center">
                                        <div style="width: 88%;" class="d-flex justify-content-between">
                                            <p class="w-50">
                                                {{$cart['product_name']}} </p>
                                                <p>
                                                    {{number_format($cart['product_price'],0,',','.')}}vnđ </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="width: 88%;" class="d-flex justify-content-center">
                                            <p class="w-100 ml-5">
                                                Mã ID: {{$cart['product_id']}} </p>
                                                <p>x{{$cart['product_qty']}}</p>
                                        </div>

                                    </div>
                                    <div class="w-100 bg-dark" style="height: 1px;"></div>

                                </div>
                                @endforeach
                              
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <div class="row d-flex justify-content-between" style="width: 88%;">
                                            <p>Đơn hàng</p>
                                            <p>{{number_format($total,0,',','.')}}vnđ</p>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::get('coupon'))
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <div class="row d-flex justify-content-between" style="width: 88%;">
                                        	@foreach(Session::get('coupon') as $key => $cou)
											@if($cou['coupon_condition']==1)
                                            <p>Giảm</p>
                                            <p>{{$cou['coupon_number']}} %</p>
                                            
														@php 
															$total_coupon = ($total*$cou['coupon_number'])/100;
														
										
															$total_after_coupon = $total-$total_coupon;
														@endphp
											@elseif($cou['coupon_condition']==2)
											<p>Giảm</p>
                                            <p>{{number_format($cou['coupon_number'],0,',','.')}} vnđ</p>
                                            				@php 
															$total_coupon = $total - $cou['coupon_number'];
														
															$total_after_coupon = $total_coupon;
															@endphp
											@endif
											@endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                {{-- @if(Session::get('fee')) --}}
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <div class="row d-flex justify-content-between" style="width: 88%;">
                                            {{-- <p>Phí vận chuyển</p> --}}
                                            <p ><span id="feeshippp"></span> </p>
                                            <?php $total_after_fee = $total + Session::get('fee'); ?>
                                        </div>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                <div class="w-100 bg-dark mb-5" style="height: 1px;"></div>
                                <div>
                                    <div class="d-flex justify-content-center">
                                        <div class="row d-flex justify-content-between" style="width: 88%;">
                                            <p>Tổng cộng</p>
                                            <p>
                                            	@php 
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').'vnđ';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo number_format($total_after,0,',','.').'vnđ';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo number_format($total_after,0,',','.').'vnđ';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').'vnđ';
											}

												@endphp

                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
                                @else
                                <tr>
										<td colspan="5"><center>
										@php 
										echo 'Đơn hàng chưa có sản phẩm thêm vào !!!';
										@endphp
										</center></td>
									</tr>

                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

@endsection