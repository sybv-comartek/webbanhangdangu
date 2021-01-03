{{-- @extends('layoutnew')
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
					<div class="login-form">
						<h2>Điền thông tin</h2>
						<form action="{{URL::to('/re-password')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Nhập Email" />
							
							<button type="submit" class="btn btn-default bg-dark">Gửi yêu cầu</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection --}}
@extends('layoutnew')
@section('content')


                        <div class="row">
                        	
                            <h4><a class="text-dark text-center" href="#">Lấy lại mật khẩu<p></p></a></h4>
                            </div>
                            @if(session('message'))
							<div class="alert alert-success ">
							{{session('message')}}
							</div>
							@elseif(session('error'))
							<div class="alert alert-danger ">
							{{session('error')}}
							</div>
							@endif
                        <div class="wrapper fadeInDown">
                            <div id="formContent">
                              <form class="mt-4" action="{{URL::to('/re-password')}}" method="POST">
                              	@csrf
                                <input type="text"  name="email_account" class="fadeIn second" placeholder="Email của bạn">
                                
                                <input type="submit"  class="fadeIn fourth bg-dark" value="Gửi yêu cầu">
                              </form>
                            </div>
                          </div>
@endsection
