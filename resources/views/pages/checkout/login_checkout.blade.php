@extends('layout')
@section('content')

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					@include('pages.notice.notice')
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							{{-- <span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span> --}}
							<span>
								<a style="" href="{{URL::to('/forget-password')}}">Quên mật khẩu ?</a>	
							</span>
							<span>
								<a style="float: right" href="{{URL::to('/change-password')}}">Đổi mật khẩu ?</a>	
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
						<hr>
						<a href="{{url('/login-facebook')}}">Login Facebook</a> |
						<a href="{{url('/login-google')}}">Login Google</a>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							<input type="text" name="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection