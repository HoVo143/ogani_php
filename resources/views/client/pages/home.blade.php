@extends('client.layout.layout')
@section('title')
    Home
  @endsection
{{-- @section('banner-home')
    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
        <div class="hero__text">
            <span>FRUIT FRESH</span>
            <h2>Vegetable <br />100% Organic</h2>
            <p>Free Pickup and Delivery Available</p>
            <a href="#" class="primary-btn">SHOP NOW</a>
        </div>
    </div>
@endsection --}}

@section('content')
<!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ( $productCategories as $productCategory)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('images/categories/cat-1.jpg') }}">
                                <h5><a href="#">{{$productCategory->name}}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            {{-- <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li> --}}
                            @foreach ( $arrayProductCategory as $item)
                                <li data-filter=".{{ Str::slug($item)}}">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ( $products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{Str::slug($product->category_name)}} fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" 
                                data-setbg="{{asset('images') . '/' . $product->image_url}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart" data-url="{{route('cart.add-product', ['id' => $product->id]) }}"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $product->name}}</a></h6>
                                <h5>${{ number_format($product->price, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ( $latesProducts as $latesProduct )
                                    <a href="#" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height:150px; width:150px;" src="{{asset('images') . '/' . $latesProduct->image_url}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $latesProduct->name}}</h6>
                                            <span>${{ number_format($latesProduct->price, 2) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ( $articles as $article)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('images/categories/cat-1.jpg') }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    {{-- {{Carbon\Carbon::createFromFormat('d/m/Y H:i:s', )->format('M j, Y')}} --}}
                                    <li><i class="fa fa-calendar-o"></i> {{$article->created_at->format('M j, Y')}}</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="#">{{ $article->title}}</a></h5>
                                {{-- so luong chu --}}
                                <p>{{ Str::limit($article->description, 150)}}</p> 
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@section('js-custom')
    <script type="text/javascript">
         $(document).ready(function(){
            $('.hero__categories ul').slideToggle(400);

            // link /cart/add-to-cart/{id}

            $('.fa-shopping-cart').on('click', function(event){
                event.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(res){
                        console.log(res);
                    }
                })
            });
         });
    </script>
@endsection