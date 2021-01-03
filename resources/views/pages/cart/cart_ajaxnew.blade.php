@extends('layoutnew')
@section('content')
	


                        <div class="row">
                            <h4><a class="text-dark" href="{{URL::to('/')}}">Trang chủ</a></h4>
                            <h4> >></h4>
                            <h4><a class="text-dark" href="#">Giỏ hàng của bạn</a></h4>
                        </div>
                        @if(session()->has('message'))
		                    <div class="alert alert-success">
		                        {!! session()->get('message') !!}
		                    </div>
		                @elseif(session()->has('error'))
		                     <div class="alert alert-danger">
		                        {!!session()->get('error') !!}
		                    </div>
		                @endif
                        <div class="row">
                        <form action="{{url('/update-cart')}}" method="POST">
								@csrf
                     	<table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                  </tr>
                                </thead>
                                <tbody>
                                	@if(Session::get('cart')==true)
									@php
											$total = 0;
									@endphp
									@foreach(Session::get('cart') as $key => $cart)
										@php
											$subtotal = $cart['product_price']*$cart['product_qty'];
											$total+=$subtotal;
										@endphp
                                  <tr>
                                    <td><img style="width: 50%;" class="card-img-top img-fluid mx-auto d-block mt-3 cart_product" 
                                        src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}"></td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center cart_description">      
                                            {{$cart['product_name']}}
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            {{number_format($cart['product_price'],0,',','.')}}vnđ
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            <input required class="cart_quantity" name="cart_qty[{{$cart['session_id']}}]" type="number" value="{{$cart['product_qty']}}" min="1" max="9999"/>
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            {{number_format($subtotal,0,',','.')}}vnđ
                                        </div>   
                                    </td>
                                    <td class="cart_delete">
										<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
									</td>
                                  </tr>
                                  @endforeach
                                  @else
                                  <tr>
										<td colspan="5"><center>
										@php 
										echo 'Giỏ hàng chưa có sản phẩm ';
										@endphp
										</center></td>
								  </tr>

                                  @endif
                                </tbody>

                              </table>
                              <table class="table">
                                <tbody>
                                	@if(Session::get('cart'))
                                    <td>
                                        <div class="row ml-2">
                                            <button type="submit" name="update_qty" class="btn btn-dark ">Cập nhật giỏ hàng</button>
                                            <button type="button" class="btn btn-dark ml-5 "><a style="color: white" class="" href="{{url('/del-all-product')}}">Xóa tất cả</a></button>
                                        </div>   
                                    </td>

                                    <td>
                                        <div class="row ml-2">
                                            <h5>Tổng tiền:{{number_format($total,0,',','.')}}vnđ</h5>
                                        </div>
                                        @if(Session::get('coupon'))
	                                        @foreach(Session::get('coupon') as $key => $cou)
											@if($cou['coupon_condition']==1)
												<div class="row ml-2">
	                                            <h6>Giảm giá:{{$cou['coupon_number']}} %</h6>
	                                        	</div>
												
												<p>
													@php 
													$total_coupon = ($total*$cou['coupon_number'])/100;
													@endphp
												</p>
												<div class="row ml-2">
                                            		<h5>Thanh toán:{{number_format($total-$total_coupon,0,',','.')}}vnđ</h5>
                                        		</div>
												
											@elseif($cou['coupon_condition']==2)
												<div class="row ml-2">
                                            		<h6>Giảm giá:{{number_format($cou['coupon_number'],0,',','.')}}vnđ</h6>
                                        		</div>
												
												<p>
													@php 
													$total_coupon = $total - $cou['coupon_number'];
									
													@endphp
												</p>
												<div class="row ml-2">
                                            		<h5>Thanh toán:{{number_format($total_coupon,0,',','.')}}vnđ</h5>
                                        		</div>
												
											@endif
											@endforeach
                            
                                        @endif 

                                        <form class="mt-4">
                                        	@if(Auth::check())
                                            <button type="submit" class="btn btn-dark ml-2"><a style="color: white;" href="{{url('/checkout')}}">Đặt hàng</a></button>
                                            @else 
                                            <button type="submit" class="btn btn-dark ml-2"><a style="color: white;" href="{{url('/dang-nhap')}}">Đặt hàng</a></button>
                                            @endif
                                        </form>
                                    </td>
                                   @endif
                                </tbody>
                              </table>
                             </form> 
                             @if(Session::get('cart'))
                             <form class="mt-4" method="POST" action="{{url('/check-coupon')}}">
                                            @csrf 
                                            <div class="form-group">
                                              <input name="coupon" type="text" class="form-control w-25" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mã giảm giá">
                                            </div>
                                                                                  
                                            <button type="submit" class="btn btn-danger check_coupon" name="check_coupon">Áp dụng</button>
                                        
                            </form>
                            @endif
                        </div>

@endsection