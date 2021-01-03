@extends('layout')
@section('content')




                        <div class="row">
                            <h4><a class="text-dark" href="{{URL::to('/')}}">Trang chủ</a></h4> <h4>>></h4>
                            <h4><a class="text-dark" href="#">Giỏ hàng của bạn</a></h4>
                        </div>
                        <div class="row w-100">
                            <?php
                                $content = Cart::content();
                                
                                ?>
                            <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($content as $v_content)
                                  <tr>
                                    <td><img style="width: 50%;" class="card-img-top img-fluid mx-auto d-block mt-3" 
                                        src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap"></td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">      
                                            Điện thoại Samsung Galaxy Note
                                            8 4G LTE, samsung, 4G, Android 
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            <input required type="number" value="" min="-100" max="9999"/>
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><img style="width: 50%;" class="card-img-top img-fluid mx-auto d-block mt-3" 
                                        src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap"></td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">      
                                            Điện thoại Samsung Galaxy Note
                                            8 4G LTE, samsung, 4G, Android 
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            <input required type="number" value="" min="-100" max="9999"/>
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><img style="width: 50%;" class="card-img-top img-fluid mx-auto d-block mt-3" 
                                        src="./image//943-9431425_samsung-galaxy-s10-samsung-galaxy-s10-plus 2.png" alt="Card image cap"></td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">      
                                            Điện thoại Samsung Galaxy Note
                                            8 4G LTE, samsung, 4G, Android 
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            <input required type="number" value="" min="-100" max="9999"/>
                                        </div>   
                                    </td>
                                    <td>
                                        <div class="h-100 d-flex align-items-center">
                                            4.999.999vnđ
                                        </div>   
                                    </td>
                                  </tr>
                                </tbody>

                              </table>
                              <table class="table">
                                <tbody>
                                    <td>
                                        <div class="row ml-2">
                                            <button type="button" class="btn btn-dark">Cập nhật giỏ hàng</button>
                                            <button type="button" class="btn btn-dark ml-5">Xóa tất cả</button>
                                        </div> 
                                        <form class="mt-4">
                                            <div class="form-group">
                                              <input type="email" class="form-control w-25" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mã giảm giá">
                                            </div>
                                            <button type="submit" class="btn btn-danger">Áp dụng</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="row ml-2">
                                            <h6>Tổng tiền:4.999.999vnđ</h6>
                                        </div> 
                                        <div class="row ml-2">
                                            <h6>Giảm giá:4.999.999vnđ</h6>
                                        </div>
                                        <div class="row ml-2">
                                            <h5>Thanh toán:4.999.999vnđ</h5>
                                        </div>
                                        <form class="mt-4">
                                            <button type="submit" class="btn btn-dark ml-2"><a href="#" style="color: white;"> Đặt hàng</button></a>
                                        </form>
                                    </td>
                                </tbody>
                              </table>
                        </div>
@endsection