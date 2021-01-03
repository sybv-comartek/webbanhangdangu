<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;
use PDF;
use App\User;
use Session;
use Mail;
use Auth;
use App\Slider;
use App\Brand;
use App\CategoryPost;
use App\Category;
use App\Advertisement;
use Illuminate\Support\Facades\View;
class OrderController extends Controller
{
	function __construct()
    {
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = Category::where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get();
       	$cate_post = CategoryPost::where('cate_post_status','0') ->orderby('cate_post_id','desc')->take(8)->get();
        $min_price =Product::min('product_price');
        $max_price =Product::max('product_price');
        $adv = Advertisement::where('adv_status','1')->get();
        $quangcaohome = 0;
        View::share('quangcaohome',$quangcaohome);
        View::share('adv',$adv);
        View::share('min_price',$min_price);
        View::share('max_price',$max_price);
        View::share('category',$cate_product);
        View::share('brand',$brand_product);
        View::share('slider',$slider);
        View::share('cate_post',$cate_post);
    }
    public function metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical){
        View::share('meta_desc',$meta_desc);
        View::share('meta_keywords',$meta_keywords);
        View::share('meta_title',$meta_title);
        View::share('url_canonical',$url_canonical);
    }
	public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
		if($order->order_status!=''){
					 $title_mail = 'Đơn hàng xác nhận ';
			         //send mail 
			         $customer = User::find(Auth::user()->getId());
			         $data['email'][] = $customer->email;
			         //lay san pham
			         foreach ($data['order_product_id'] as $key=>$product) {
			         	$product_mail = Product::find($product);
			         	foreach ($data['quantity'] as $key2 => $qty) {
			         		if($key==$key2){
			         			$cart_array[] = array(
			         				'product_name'=> $product_mail['product_name'],
									'product_price'=> $product_mail['product_price'],
									'product_qty'=> $qty
			         			);
			         		}
			         	}
			         }
			         //lay shipping
			         $details = OrderDetails::where('order_code',$order->order_code)->first();
			         $fee_ship = $details->product_feeship;
			         $coupon_mail = $details->product_coupon;
			         $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
			         $shipping_array = array(
			         'fee'=>$fee_ship,
			         'customer_name'=>$customer->name,
			         'shipping_name'=>$shipping->shipping_name,
			         'shipping_email'=>$shipping->shipping_email,
			         'shipping_phone'=>$shipping->shipping_phone,
			         'shipping_address'=>$shipping->shipping_address,
			         'shipping_notes'=>$shipping->shipping_notes,
			         'shipping_method'=>$shipping->shipping_method
			         );
			          $coupon_code = array(
			            'coupon_code'=>$coupon_mail,
			            'order_code'=>$details->order_code
			         );

			         
				if($order->order_status==1){

				}	elseif ($order->order_status==2) {
					Mail::Send('admin.mail_accept.mail_accept',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$coupon_code],function($message)use ($title_mail,$data){
			            $message->to($data['email'])->subject($title_mail);
			            $message->from($data['email'],$title_mail);
			         });
				}elseif ($order->order_status==3) { 
					Mail::Send('admin.mail_accept.mail_reject',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$coupon_code],function($message)use ($title_mail,$data){
			            $message->to($data['email'])->subject($title_mail);
			            $message->from($data['email'],$title_mail);
			         });
				}

		}
		//end

			if($order->order_status==2){
						foreach($data['order_product_id'] as $key => $product_id){
							
							$product = Product::find($product_id);
							$product_quantity = $product->product_quantity;
							$product_sold = $product->product_sold;
							foreach($data['quantity'] as $key2 => $qty){
									if($key==$key2){
											$pro_remain = $product_quantity - $qty;
											$product->product_quantity = $pro_remain;
											$product->product_sold = $product_sold + $qty;
											$product->save();
									}
							}
						}
					}elseif($order->order_status!=2 && $order->order_status!=3){
						foreach($data['order_product_id'] as $key => $product_id){
							
							$product = Product::find($product_id);
							$product_quantity = $product->product_quantity;
							$product_sold = $product->product_sold;
							foreach($data['quantity'] as $key2 => $qty){
									if($key==$key2){
											$pro_remain = $product_quantity + $qty;
											$product->product_quantity = $pro_remain;
											$product->product_sold = $product_sold - $qty;
											$product->save();
									}
							}
						}
					}
		


	}
	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = User::where('id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						<td>'.$shipping->shipping_notes.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không mã';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.number_format($product->product_feeship,0,',','.').'đ'.'</td>
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'</p>
					<p>Phí ship: '.number_format($product->product_feeship,0,',','.').'đ'.'</p>
					<p>Thanh toán : '.number_format($total_coupon + $product->product_feeship,0,',','.').'đ'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
	public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = User::where('id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));

	}
    public function manage_order(){
    	$order = Order::orderby('created_at','DESC')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }

    public function delete_order($order_code){
    	$order_delete = Order::where('order_code',$order_code);
    	$order_details = OrderDetails::where('order_code',$order_code);
    	$order_details->delete();
    	$order_delete->delete();
    	$order = Order::orderby('created_at','DESC')->get();
    	Session::put('message','Xóa đơn hàng thành công');
    	return redirect('/manage-order')->with(compact('order'));

    }

    public function history_checkout(Request $request){
    	if(!Auth::check()){
    		return Redirect::to('/dang-nhap')->with('error','Vui lòng đăng nhâp để xem lịch sử đơn hàng...');
    	}else{
		    	$meta_desc = "Lịch sử đơn hàng"; 
		        $meta_keywords = "Lịch sử đơn hàng";
		        $meta_title = "Lịch sử đơn hàng";
		        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);
    		$order = Order::where('customer_id',Auth::user()->getId())->orderBy('order_id','DESC')->get();
    		return view('pages.history_checkout.history_checkout')->with(compact('order'));
    	}
    }
    public function view_detail_history_checkout(Request $request,$order_code){
    	if(!Auth::check()){
    		return Redirect::to('/dang-nhap')->with('error','Vui lòng đăng nhâp để xem lịch sử đơn hàng...');
    	}else{
    			$meta_desc = "Lịch sử đơn hàng"; 
		        $meta_keywords = "Lịch sử đơn hàng";
		        $meta_title = "Lịch sử đơn hàng";
		        $url_canonical = $request->url();
        $this->metaseo($meta_desc,$meta_keywords,$meta_title,$url_canonical);

        //lich su don hang
	        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
			$order = Order::where('order_code',$order_code)->first();
				$customer_id = $order->customer_id;
				$shipping_id = $order->shipping_id;
				$order_status = $order->order_status;
			$customer = User::where('id',$customer_id)->first();
			$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		


			$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

			foreach($order_details_product as $key => $order_det){

				$product_coupon = $order_det->product_coupon;

			}
			if($product_coupon != 'no'){
				$coupon = Coupon::where('coupon_code',$product_coupon)->first();
				$coupon_condition = $coupon->coupon_condition;
				$coupon_number = $coupon->coupon_number;
			}else{
				$coupon_condition = 2;
				$coupon_number = 0;
			}
			return view('pages.history_checkout.view_details_history_checkout')->with(compact('order','order_details','customer','shipping','coupon_condition','coupon_number','order_status','order_code'));
    	}
    }
    public function cancel_order(Request $request,$order_code){
    	$order = Order::where('order_code',$order_code)->first();
    	$order->order_status = 3;
		$order->save();
		return redirect::back()->with('thongbao','Hủy đơn hàng thành công');
    }
}
