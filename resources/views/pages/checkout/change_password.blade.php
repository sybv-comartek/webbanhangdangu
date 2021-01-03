@extends('layout')
@section('content')


		<div style="margin-left: 100px" class="container">
			<div class="row">
					@include('pages.notice.notice')
					<div style="margin-left: 200px" class="login-form"><!--login form-->
						<h2>Thay đổi mật khẩu</h2>
						<form action="{{URL::to('/save-password')}}" method="POST">
							{{csrf_field()}}


							<h7>Nhập tên tài khoản</h7>
							<input style="width: 570px" type="text" name="email_account"  placeholder="Tài khoản" />

							<div class="form-group">
							<h7>Nhập mật khẩu cũ</h7>
							<input style="width: 570px" class="form-control" type="password" name="password_account" placeholder="Password" />

							<div class="form-group">
							<h7>Nhập mật khẩu mới</h7>
							<input style="width: 570px" class="form-control" type="password" name="password_change" placeholder="Password" />
							</div>
							<button type="submit" class="btn btn-default">Đổi mật khẩu</button>
						</form>
					</div><!--/login form-->
				
			</div>
		</div>


@stop
