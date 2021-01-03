@include('pages.header_footer.headernew')
<section class="home-section">
            <div class="container">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#demo" data-slide-to="0" class="active"></li>
                      <li data-target="#demo" data-slide-to="1"></li>
                      <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    
                    <!-- The slideshow -->
                    <div class="carousel-inner d-flex align-items-center justify-content-center" style="height:600px">
                      {{-- <div class="carousel-item active">
                        <img src="./image/vai-tro-cua-banner-1024x549 1.png" alt="Los Angeles">
                      </div>
                      <div class="carousel-item">
                        <img src="./image/vai-tro-cua-banner-1024x549 1.png" alt="Chicago">
                      </div>
                      <div class="carousel-item">
                        <img src="./image/vai-tro-cua-banner-1024x549 1.png" alt="New York"> --}}
                        @php 
                            $i = 0;
                        @endphp
                        @foreach($slider as $key => $slide)
                            @php 
                                $i++;
                            @endphp
                            <div class="item {{$i==1 ? 'active' : '' }}">
                               
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="200" width="100%" class="img img-responsive">
                                   
                                </div>
                            </div>
                        @endforeach  
                    </div>
                    <!-- Left and right controls -->
                    <a  class="carousel-control-prev" href="#demo" data-slide="prev" >
                        <i class='fas fa-chevron-circle-left' style='font-size:36px;color: black'></i>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <i class='fas fa-chevron-circle-right' style='font-size:36px;color: black;'></i>
                    </a>
                </div>
            </div>
            </div>
</section>
<section class="home-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card-boder mt-4 px-0 w-100 p-4">
                            <h5 class="ml-3 mt-4 text-dark font-weight-bold" style="font-size: 17px;">DANH MỤC SẢN PHẨM</h5>
                            @foreach($category as $key => $cate)
                            	<a class="text-dark ml-3 mt-4" href="{{URL::to('/danh-muc/'.$cate->slug_category_product)}}" class="card-link">{{$cate->category_name}}</a>
                            @endforeach
         
                        </div>
                        <div class="card-boder mt-4 px-0 w-100 p-4">
                            <h5 class="ml-3 mt-4 text-dark " style="font-size: 17px;">THƯƠNG HIỆU SẢN PHẨM</h5>
                             @foreach($brand as $key => $brand)
                             	<a class="text-dark ml-3 mt-4" href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}" class="card-link">{{$brand->brand_name}}</a>
                             @endforeach
                            
                        </div>
                        @if($quangcaohome==1)
                        @foreach($adv as $key=>$adv)
                        <div>
                            <img class="card-img-top img-fluid mx-auto d-block mt-4" src="{{asset('public/uploads/adv/'.$adv->adv_image)}}" alt="">
                        </div>
                        @endforeach
                        @endif
                       {{--  <div>
                            <img class="card-img-top img-fluid mx-auto d-block mt-4" src="../public/uploads/adv/b01_-all_cf22e19eb5cf498c85011e1df0e43137 1.png" alt="Card image cap">
                        </div> --}}
                        
                    </div>
                    <div class="col-lg-9">
                    	@yield('content')
                    </div>
               	</div>
            </div>
        </section>
@include('pages.header_footer.footer')


{{-- script --}}

 <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>


    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/ghtslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script>
<script type="text/javascript">
    $('.xemnhanh').click(function(){
       var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/quickview') }}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id,_token:_token},
            success:function(data){
                $('#product_quickview_title').html(data.product_name);
                 $('#product_quickview_id').html(data.product_id);
                  $('#product_quickview_price').html(data.product_price);
                   $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                     $('#product_quickview_desc').html(data.product_desc);
                      $('#product_quickview_content').html(data.product_content);
                        $('#product_quickview_value').html(data.product_quickview_value);
                      

            }
        });
    });
</script>
<script type="text/javascript">
    $('.xemnhanhc').click(function(){
       var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/quickviewc') }}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id,_token:_token},
            success:function(data){
                $('#product_quickview_title').html(data.product_name);
                 $('#product_quickview_id').html(data.product_id);
                  $('#product_quickview_price').html(data.product_price);
                   $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                     $('#product_quickview_desc').html(data.product_desc);
                      $('#product_quickview_content').html(data.product_content);
                        $('#product_quickview_value').html(data.product_quickview_value);
                      

            }
        });
    });
</script>
<script type="text/javascript">
    
    $('#keywords').keyup(function(){
        var query = $(this).val();

        if(query !=''){ 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('/autocomplete-ajax') }}",
                method:"POST",
                data:{query:query,_token:_token},
                success:function(data){
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        }else{
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click','.li_search_ajax',function(){
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>
<script type="text/javascript">
     $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>
    <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,100);

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });

               
            });
        });
    

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt (cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Nhập quá số lượng hàng đang có');
                }
                else {

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                    success:function(){

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }

                });
            }
            });
        });
    </script>
   {{--  add to cart quickview --}}
       <script type="text/javascript">
        
            $(document).on('click','.add-to-cart-quickview',function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt (cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Nhập quá số lượng hàng đang có');
                }
                else {

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                    
                    //     beforeSend:function(){
                    //         $("#before_cart").html("<p class='text text-primary'> Đang thêm vào giỏ hàng </p>");
                    //     },
                    //     success:function(){
                    //          $("#before_cart").html("<p class='text text-success'> Đã thêm vào giỏ hàng </p>");
                    // }
                    success:function(){

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }

                });
            }
            });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.wards').on('change',function(){
                // alert('ok');
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                // alert('ok');
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Vui lòng chọn địa điểm bạn muốn gửi hàng đến');

                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(data){
                        // alert('ok');
                        // $('#feeshipp').html(data.feeshipp);
                        $('#feeshippp').html(data);
                        $('#feeshi').html(data);
                        // alert(data);,_token:_token
                       // location.reload(); 
                    }
                    });
                } 
                }); 
    });
    //     $(document).ready(function(){
    //         $('.calculate_delivery').click(function(){
    //             var matp = $('.city').val();
    //             var maqh = $('.province').val();
    //             var xaid = $('.wards').val();
    //             var _token = $('input[name="_token"]').val();
    //             if(matp == '' && maqh =='' && xaid ==''){
    //                 alert('Làm ơn chọn để tính phí vận chuyển');
    //             }else{
    //                 $.ajax({
    //                 url : '{{url('/calculate-fee')}}',
    //                 method: 'POST',
    //                 data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
    //                 success:function(){
    //                    location.reload(); 
    //                 }
    //                 });
    //             } 
    //     });
    // });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#filter').on('change',function(){
                var url = $(this).val();

                if(url){
                    window.location = url;
                }
                return false;
            });
        });
    </script>
    <script>
  $(document).ready(function(){
    $( "#slider-range" ).slider({
      orientation: "horizontal",
      range: true,
      min:{{ $min_price }},
      max:{{ $max_price }},
      steps:100000,
      values: [ {{ $min_price }}, {{ $max_price }} ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "vnd" + ui.values[ 0 ] + " - vnd" + ui.values[ 1 ] );
        $( "#start_price" ).val(ui.values[ 0 ] );
        $( "#end_price" ).val(ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "vnd" + $( "#slider-range" ).slider( "values", 0 ) +
      " - vnd" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>
<script type="text/javascript">
    // function remove_background(product_id)
    // {
    //     for(var count=1;count<=5;count++){
    //         $('#'+product_id+'-'+count).css('color','#ccc');
    //     }
    // }
    // $(document).on('mouseenter','.rating',function(){
    //     var index = $(this).data("index");

    //     var product_id = $(this).data('product_id');
    //     // alert(index);
    //     // alert(product_id);
    //     var rating =$(this).data("rating");
    //     remove_background(product_id);
    //     for(var count=1;count<=index;count++){
    //         $('#'+product_id+'-'+count).css('color','#ffcc00');
    //     }
    // });
    // $(document).on('mouseleave','.rating',function(){
    //     var index = $(this).data("index");
    //     var product_id = $(this).data('product_id');
    //     var rating =$(this).data("rating");
    //     remove_background(product_id);
    //     for(var count=1;count<=rating;count++){
    //         $('#'+product_id+'-'+count).css('color','#ffcc00');
    //     }
    // });
    // $(document).on('click','.rating',function(){
    //     var index = $(this).data("index");
    //     var product_id = $(this).data('product_id');
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url:
    //     });

    // });

</script>
  {{-- update --}}
  <script>
        $(document).ready(function(){
            $('.customer-logos').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                arrows: false,
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 3
                    }
                }]
            });
        });
    </script>
  @yield('script')
</body>
</html>
