@extends('layout')
@section('content')

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-sm-offset-1">
					@if(session('message'))
					<div class="alert alert-success ">
					{{session('message')}}
					</div>
					@elseif(session('error'))
					<div class="alert alert-danger ">
					{{session('error')}}
					</div>
					@endif
					<div class="login-form"><!--login form-->
						@php 
						$token = $_GET['token'];
						$email = $_GET['email'];
						@endphp
						<h2>Điền mật khẩu mới</h2>
						<form action="{{URL::to('/save-new-password')}}" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="email" value="{{ $email }}">
							<input type="hidden" name="token" value="{{ $token }}">
							<input type="text" name="password_account" placeholder="Nhập mật khẩu mới..." />
							
							<button type="submit" class="btn btn-default">Gửi yêu cầu</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection