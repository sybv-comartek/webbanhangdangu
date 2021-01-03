@extends('layoutnew')
@section('content')

                        <div class="row">
                            @include('pages.notice.notice')
                            <h4><a class="text-dark text-center" href="{{URL::to('/dang-nhap')}}">Đăng nhậ<p></p></a></h4>
                            <h4 class="ml-4"><a class="text-dark text-center" href="{{URL::to('/dang-ky')}}">Đăng kí</a></h4>
                        </div>
                        <div class="wrapper fadeInDown">
                            <div id="formContent" >
                              <form class="mt-4" action="{{URL::to('/add-customer')}}" method="POST">
                                @csrf
                                <input type="text"  class="fadeIn second" name="customer_name"  placeholder="Họ & tên">
                                <input type="text"  class="fadeIn third" name="customer_email" placeholder="Địa chỉ email">
                                <input type="text"  class="fadeIn second" name="customer_phone" placeholder="Số điện thoại">
                                <input type="text" class="fadeIn third" name="customer_password" placeholder="Mật khẩu">

                                <input type="submit" class="fadeIn fourth bg-dark" value="ĐĂNG KÍ">
                              </form>
                            </div>
                          </div>
@endsection