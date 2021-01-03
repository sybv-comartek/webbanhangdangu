@extends('layoutnew')
@section('content')

        <section class="home-section">
            <div class="container-fluid">
                <h4 class="text-center"><a class="text-dark" href="#">Gửi thông tin liên hệ</a></h4>
                <p class="text-center mt-3" style="background-color: #EFEDED;"><i>BẠN CẦN TRỢ GIÚP, HÃY LIÊN HỆ VỚI CHÚNG TÔI!</i></p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="card-boder-checkoutcart mt-4 px-0">
                                <div>
                                    <h4 class="m-3"><a class="text-dark" href="#">Góp ý liên hệ</a></h4>
                                    <form action="{{URL::to('/send-mail')}}" method="POST">
                                    	@csrf
                                        <div class="">
                                        <div class="col mt-3">
                                            <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Họ và tên">
                                        </div>
                                        <div class="col mt-3">
                                            <input type="text" class="form-control"  id="email" name="email" placeholder="Email">
                                        </div>
                                        <div class="col mt-3 form-group">
                                            <textarea placeholder="Nội dung liên hệ" name="comment"  class="form-control" id="comment" rows="10"></textarea>
                                        </div>
                                        </div>
                                    
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-dark mb-3 w-50">GỬI THÔNG TIN LIÊN HỆ</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="card-boder-checkoutcart mt-4 px-0 m-2">
                                <div>
                                    <h4 class="m-3"><a class="text-dark" href="#">ĐỊA CHỈ</a></h4>
                                    <p class="m-3">Số 4, Toà nhà Phố Lụa, 36 Phố Lụa,</p>
                                    <p class="m-3"> P. Vạn Phúc, Q.Hà Đông, Tp.Hà Nội</p>
                                    <p class="m-3">Tel: +84 96 644598</p>
                                    <p class="m-3">Fax:+84 28 88888888</p>
                                </div>
                                <div class="w-100 bg-dark" style="height: 1px;"></div>
                                <div>
                                    <h4 class="m-3"><a class="text-dark" href="#">Tại Hà Nội</a></h4>
                                    <p class="m-3">Số 4, Toà nhà Phố Lụa, 36 Phố Lụa,</p>
                                    <p class="m-3"> P. Vạn Phúc, Q.Hà Đông, Tp.Hà Nội</p>
                                    <p class="m-3">Tel: +84 96 644598</p>
                                    <p class="m-3">Fax:+84 28 88888888</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
            <br>
            <br>
        </section>

@endsection