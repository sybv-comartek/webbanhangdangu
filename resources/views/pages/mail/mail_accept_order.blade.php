<!DOCTYPE html>
<html>
<head>
	<title>Mail Xác nhận đặt hàng</title>
</head>
<body>
<div class="col-md-12">
	<h2 style="text-align: center;"> Công ty TNHH DAHOANG </h2>
	<h2 style="text-align: center;"> Chuyên Phụ Kiện, Thiết Bị Điện Tử Mới Nhất, Giá Tốt Nhất </h2>
	<p> Xin chào bạn : {{ $shipping_array['customer_name'] }} , </p>
	<p> Cảm ơn bạn đã tin tưởng và đặt hàng từ cửa hàng của chúng tôi</p>
	<p> Đơn hàng của bạn đã được xác nhận đặt hàng, chúng tôi sẽ xử lý và gửi tới bạn trong thời gian sớm nhất</p>
	<h3>Thông tin đặt hàng của bạn :</h3>
	<p> Mã đơn hàng : {{ $code['order_code'] }}</p>
	<p> Mã khuyến mại :  {{ $code['coupon_code'] }}</p>
	<p> Dịch vụ : Đặt hàng trực tuyến</p>
	<h3>Thông tin đặt hàng của bạn :</h3>
	<p> Email : 
		@if($shipping_array['shipping_email']=='')
		Không có
		@else
		<span>{{ $shipping_array['shipping_email'] }}</span>
		@endif
		</p>
	<p> Họ và tên người nhận : 
		@if($shipping_array['shipping_email']=='')
		Không có
		@else
		<span>{{ $shipping_array['shipping_email'] }}</span>
		@endif
		</p>
	</p>
	<p> Địa chỉ nhận hàng : 
		@if($shipping_array['shipping_address']=='')
		Không có
		@else
		<span>{{ $shipping_array['shipping_address'] }}</span>
		@endif
		</p>
	</p>
	<p> Số điện thoại : 
		@if($shipping_array['shipping_phone']=='')
		Không có
		@else
		<span>{{ $shipping_array['shipping_phone'] }}</span>
		@endif
		</p>
	</p>
	<p> Ghi chú : 
		@if($shipping_array['shipping_notes']=='')
		Không có
		@else
		<span>{{ $shipping_array['shipping_notes'] }}</span>
		@endif
		</p>
	</p>
	<p> Phương thức thanh toán : 
		@if($shipping_array['shipping_method']==0)
		Chuyển khoản 
		@else
		Thanh toán khi nhận hàng
		@endif
		</p>
	</p>
	<h3>Sản phẩm đã đặt hàng :</h3>
	<table class="tab table-striped" style="border: 1px">
		
		<thead>
			<tr>
				<th>Sản phẩm</th>
				<th>Giá tiền</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
			</tr>
		</thead>
		<tbody>
			@php
			$total = 0;
			$s_total = 0;
			@endphp
			@foreach($cart_array as $cart)
				@php
					
					$s_total = $cart['product_qty']*$cart['product_price'];
					$total += $s_total;
				@endphp
				<tr>
					<td>{{ $cart['product_name'] }}</td>
					<td>{{ number_format($cart['product_price'],0,',','.') }}vnđ</td>
					<td>{{ $cart['product_qty'] }}</td>
					<td>{{number_format($s_total,0,',','.')}}vnđ</td>
				</tr>
			@endforeach
				<tr>
					<td colspan="4" align="right">Phí ship : {{number_format($shipping_array['fee'],0,',','.')}}vnđ</td>
				</tr>
				<tr>
					<td colspan="4" align="right">Tổng tiền thanh toán : {{number_format($total,0,',','.')}}vnđ</td>
				</tr>

		</tbody>
	</table>

</div>
<p>Mọi chi tiết xin liên hệ hotline : 0966644598 để biết thêm chi tiết</p>
<p>Đây là mail tự động. quý khách vui lòng không trả lời lại mail này.</p>
<p>Trân thành cảm ơn !!!</p>
</body>
</html>