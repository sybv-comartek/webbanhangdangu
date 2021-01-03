 @extends('layoutnew')
@section('content')

 <section class="home-section">
            <div class="container-fluid">
                <div class="row">
                    @foreach($post_detail as $key => $po)
                    <div class="card-boder-detail mt-4 px-0 w-100">
                        <div class="w-50 m-4">
                            <h4>{{$po->cate_post->cate_post_name }}</h4>
                            <h3 class="font-weight-bold" style="font-size: 20px;">{{ $meta_title }}</h3>
                        </div>
                        
                        <div class="row m-4">
                            <p>{{ $po->post_author }}</p>
                            <p class="ml-5">{{ $po->created_at }}</p>
                        </div>

                        <div class="bg-dark w-100" style="height: 1px;"></div>
                        <div class="row m-3">
                            <div class="col-lg-8">
                                <div>
                                    <h5>
                                        {!! $po->post_desc !!}
                                    </h5>
                                </div>
                                <div>
                                    {!! $po->post_content !!}
                                </div>
                                {{-- <div>
                                    <p>
                                        Năm 2020, thị trường di động thế giới chứng kiến rất nhiều trường hợp hi hữu. Đơn cử là lần đầu tiên sau nhiều năm,
                                         model iPhone kế nhiệm lại có giá niêm yết thấp hơn so với sản phẩm ra mắt trước đó.
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Năm 2020, thị trường di động thế giới chứng kiến rất nhiều trường hợp hi hữu. Đơn cử là lần đầu tiên sau nhiều năm,
                                         model iPhone kế nhiệm lại có giá niêm yết thấp hơn so với sản phẩm ra mắt trước đó.
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Năm 2020, thị trường di động thế giới chứng kiến rất nhiều trường hợp hi hữu. Đơn cử là lần đầu tiên sau nhiều năm,
                                         model iPhone kế nhiệm lại có giá niêm yết thấp hơn so với sản phẩm ra mắt trước đó.
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Cụ thể, iPhone XS Max và 11 Pro Max ra mắt lần lượt vào năm 2018 và
                                         2019 đều sở hữu mức giá 1.099 USD cho phiên bản bộ nhớ trong 64GB. Trong khi đó, phiên bản 12 Pro Max của năm nay cũng là 1.099 USD nhưng bộ nhớ trong đã lên đến 128GB. Nó rẻ hơn 2 mẫu flagship cũ, ở một khía cạnh nào đó.

                                    </p>
                                </div> --}}
                                {{-- <div>
                                    <img class="img-fluid img-thumbnail" src="{{URL::to('public/uploads/post/'.$po->post_image)}}" alt="New York">
                                </div> --}}
                                {{-- <button type="button" class="btn btn-dark mx-auto d-block mt-2">Xem thêm</button> --}}
                            </div>
                           
                            <!-- <div class="col-lg-4">
                                <div>
                                    <img class="img-fluid img-thumbnail" src="{{URL::to('public/uploads/adv/'.$po->post_image_adv)}}" alt="">
                                </div>
                            </div> -->
                            @endforeach
                        </div>
                        <div class="m-3">
                            <div>
                                <h5 class="ml-2 font-weight-bold">ĐỌC THÊM BÀI VIẾT LIÊN QUAN</h5>
                            </div>
                            <div class="row">
                                @foreach($related_post as $ke => $re)
                                {{-- <form>
                                 @csrf --}}
                                <div class="col-lg-3">
                                    <div>
                                        <a style="color: black" href="{{URL::to('/bai-viet/'.$re->post_slug)}}">
                                            <img style="width:100%;height:230px;" class="img-fluid img-thumbnail" src="{{URL::to('public/uploads/post/'.$re->post_image)}}" alt="New York">
                                        <p class="font-weight-bold">{{$re->post_title}}</p>
                                        </a>
                                    </div> 
                                </div>
                                {{-- </form> --}}
                                @endforeach
                                 
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection