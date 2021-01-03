@extends('layoutnew')
@section('content')


                        <div class="row">
                          @include('pages.notice.notice')
                            <h4><a class="text-dark text-center" href="{{URL::to('/dang-nhap')}}">Đăng nhập</a></h4>
                            <h4 class="ml-4"><a class="text-dark text-center" href="{{URL::to('/dang-ky')}}">Đăng kí</a></h4>
                        </div>
                        <div class="wrapper fadeInDown">
                            <div id="formContent" >
                              <form class="mt-4" action="{{URL::to('/login-customer')}}" method="POST">
                                @csrf
                                <input type="text"  class="fadeIn second" name="email_account" placeholder="Tài khoản">
                                <input type="text"  class="fadeIn third" name="password_account" placeholder="Mật khẩu">
                                
                                <input type="submit" class="fadeIn fourth bg-dark" value="Đăng nhập">
                              </form>
                              <div class="row d-flex justify-content-center m-3">
                                    <a href="{{url('/login-facebook')}}"><i class='fab fa-facebook mr-5' style='font-size:24px'></i></a>
                                    <a href="{{url('/login-google')}}"><i class='fab fa-google' style='font-size:24px'></i></a>
                              </div>
                              <div id="formFooter">
                                <a class="underlineHover float-left mb-3" href="{{URL::to('/forget-password')}}">Quên mật khẩu?</a>
                                <a class="underlineHover float-right" href="{{URL::to('/change-password')}}">Đổi mật khẩu??</a>
                              </div>
                          
                            </div>
                          </div>
@endsection