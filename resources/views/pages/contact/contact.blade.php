@extends('layout')
@section('content')


<style type="text/css">
	.contact{
		padding: 4%;
		height: 400px;
	}
	.col-md-3{
		background: #ff9b00;
		padding: 4%;
		border-top-left-radius: 0.5rem;
		border-bottom-left-radius: 0.5rem;
	}
	.contact-info{
		margin-top:10%;
	}
	.contact-info img{
		margin-bottom: 15%;
	}
	.contact-info h2{
		margin-bottom: 10%;
	}
	.col-md-9{
		background: #fff;
		padding: 3%;
		border-top-right-radius: 0.5rem;
		border-bottom-right-radius: 0.5rem;
	}
	.contact-form label{
		font-weight:600;
	}
	.contact-form button{
		background: #25274d;
		color: #fff;
		font-weight: 600;
		width: 25%;
	}
	.contact-form button:focus{
		box-shadow:none;
	}
</style>
<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
				<h2>Liên Hệ Chúng Tôi</h2>
				<h4>Chúng tôi lắng nghe ý kiến từ bạn !!!</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<form action="{{URL::to('/send-mail')}}" method="POST">
					{{csrf_field()}}
				<div class="form-group">
				  <label class="control-label col-sm-2" for="fname">Họ và Tên:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="hoten" placeholder="Nhập họ và tên" name="hoten">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="email">Email:</label>
				  <div class="col-sm-10">
					<input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="comment">Ý kiến đóng góp:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
				  </div>
				</div>
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Submit</button>
				  </div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection