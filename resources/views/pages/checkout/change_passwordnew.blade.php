@extends('layoutnew')
@section('content')


                        <div class="row">
                        	@include('pages.notice.notice')
                            <h4><a class="text-dark text-center" href="#">Thay đổi mật khẩu<p></p></a></h4>
                            </div>
                        <div class="wrapper fadeInDown">
                            <div id="formContent">
                              <form class="mt-4" action="{{URL::to('/save-password')}}" method="POST">
                              	@csrf
                                <input type="text"  name="email_account" class="fadeIn second" placeholder="Email">
                                <input type="text" id="password" name="password_account" class="fadeIn third"  placeholder="Mật khẩu cũ">
                                <input type="text" name="password_change"  class="fadeIn second"  placeholder="Mật khẩu mới">

                                <input type="submit"  class="fadeIn fourth bg-dark" value="Đổi mật khẩu">
                              </form>
                            </div>
                          </div>
@endsection
