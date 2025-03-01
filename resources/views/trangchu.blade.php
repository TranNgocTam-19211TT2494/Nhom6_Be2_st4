@extends('layouts.master')
@section('content')
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            @if (count($categories) >= 5)
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $category)
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{$category->photo}}">
                        <h5><a href="{{route('product.category',$category->id)}}">{{$category->title}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="categories__slider owl-carousel">
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('img/categories/cat-1.jpg')}}">
                        <h5><a href="{{route('product.all')}}">Fresh Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('img/categories/cat-2.jpg')}}">
                        <h5><a href="{{route('product.all')}}">Dried Fruit</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('img/categories/cat-3.jpg')}}">
                        <h5><a href="{{route('product.all')}}">Vegetables</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('img/categories/cat-4.jpg')}}">
                        <h5><a href="{{route('product.all')}}">drink fruits</a></h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{asset('img/categories/cat-5.jpg')}}">
                        <h5><a href="{{route('product.all')}}">drink fruits</a></h5>
                    </div>
                </div>
            </div>
            @endif

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
                        <li class="active" data-filter="*">All</li>
                        @isset($cate1) <li data-filter=".{{$cate1->title}}">{{$cate1->title}}</li>@endisset
                        @isset($cate2) <li data-filter=".{{$cate2->title}}">{{$cate2->title}}</li>@endisset
                        @isset($cate3) <li data-filter=".{{$cate3->title}}">{{$cate3->title}}</li>@endisset
                        @isset($cate4) <li data-filter=".{{$cate4->title}}">{{$cate4->title}}</li>@endisset
                    </ul>
                </div>
            </div>
        </div>
        <!-- Đổ dữ liệu từ bảng product ra trang chủ -->
        <div class="row featured__filter">
            @isset($cate1)
            @foreach ($cate1->products->take(6) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mix {{$cate1->title}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="@php
                $image=explode(',',$product->photo);
                echo $image[0];
                @endphp">
                        <ul class="featured__item__pic__hover">
                            @php
                            $count=0;
                            if(Auth::user())
                            {
                            $count = App\Models\Wishlist::where(['product_id' =>
                            $product->id,'user_id'=>Auth::user()->id])->count();
                            }
                            @endphp
                            @if($count == "0")
                            <li>
                                <a href="{{route('wishlist.add',$product->id)}}"> <i class="fa fa-heart"></i></a>
                            </li>
                            @else
                            <li><a href="{{route('wishlist.remove',$product->id)}}" style="background: red;"><i class="fa fa-heart"></i></a></li>
                            @endif
                            <li><a href="{{route('cart.add',$product->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('product.detail',$product->slug)}}">{{$product->title}}</a></h6>
                        <h5>{{number_format($product->price)}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset
            @isset($cate2)
            @foreach ($cate2->products->take(6) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 {{$cate2->title}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="@php
                $image=explode(',',$product->photo);
                echo $image[0];
                @endphp">
                        <ul class="featured__item__pic__hover">
                            @php
                            $count=0;
                            if(Auth::user())
                            {
                            $count = App\Models\Wishlist::where(['product_id' =>
                            $product->id,'user_id'=>Auth::user()->id])->count();
                            }
                            @endphp
                            @if($count == "0")
                            <li>
                                <a href="{{route('wishlist.add',$product->id)}}"> <i class="fa fa-heart"></i></a>
                            </li>
                            @else
                            <li><a href="{{route('wishlist.remove',$product->id)}}" style="background: red;"><i class="fa fa-heart"></i></a></li>
                            @endif
                            <li><a href="{{route('cart.add',$product->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('product.detail',$product->slug)}}">{{$product->title}}</a></h6>
                        <h5>{{number_format($product->price)}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset
            @isset($cate3)
            @foreach ($cate3->products->take(6) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 {{$cate3->title}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="@php
                $image=explode(',',$product->photo);
                echo $image[0];
                @endphp">
                        <ul class="featured__item__pic__hover">
                            @php
                            $count=0;
                            if(Auth::user())
                            {
                            $count = App\Models\Wishlist::where(['product_id' =>
                            $product->id,'user_id'=>Auth::user()->id])->count();
                            }
                            @endphp
                            @if($count == "0")
                            <li>
                                <a href="{{route('wishlist.add',$product->id)}}"> <i class="fa fa-heart"></i></a>
                            </li>
                            @else
                            <li><a href="{{route('wishlist.remove',$product->id)}}" style="background: red;"><i class="fa fa-heart"></i></a></li>
                            @endif
                            <li><a href="{{route('cart.add',$product->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('product.detail',$product->slug)}}">{{$product->title}}</a></h6>
                        <h5>{{number_format($product->price)}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset
            @isset($cate4)
            @foreach ($cate4->products->take(6) as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 {{$cate4->title}}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="@php
                $image=explode(',',$product->photo);
                echo $image[0];
                @endphp">
                        <ul class="featured__item__pic__hover">
                            @php
                            $count=0;
                            if(Auth::user())
                            {
                            $count = App\Models\Wishlist::where(['product_id' =>
                            $product->id,'user_id'=>Auth::user()->id])->count();
                            }
                            @endphp
                            @if($count == "0")
                            <li>
                                <a href="{{route('wishlist.add',$product->id)}}"> <i class="fa fa-heart"></i></a>
                            </li>
                            @else
                            <li><a href="{{route('wishlist.remove',$product->id)}}" style="background: red;"><i class="fa fa-heart"></i></a></li>
                            @endif
                            <li><a href="{{route('cart.add',$product->slug)}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{route('product.detail',$product->slug)}}">{{$product->title}}</a></h6>
                        <h5>{{number_format($product->price)}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset
        </div>
        <!-- Kết thúc đổ dữ liệu ra trang chủ -->
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{asset('img/banner/banner-1.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <a href="{{route('product.all')}}"><img src="{{asset('img/banner/banner-2.jpg')}}" alt=""></a>

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
                        @if ($latest && count($latest) >= 4)

                        @for ($i=0; $i < 2 ; $i++) @php $j=3; $k=0; @endphp <div class="latest-prdouct__slider__item">
                            @for ($k;$k<$j;$k++) <a href="{{route('product.detail',$latest[$k]->slug)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="@php
                $image=explode(',',$latest[$k]->photo);
                echo $image[0];
                @endphp" alt="{{$latest[$k]->title}}">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$latest[$k]->title}}</h6>
                                    <span>{{number_format($latest[$k]->price)}}</span>
                                </div>
                                </a>
                                @endfor
                                @php
                                $j=6;
                                $k=3;
                                @endphp
                    </div>
                    @endfor
                    @endif
                </div>
            </div>

        </div>



        <div class="col-lg-4 col-md-6">
            <div class="latest-product__text">
                <h4>Top Hot Products</h4>
                <div class="latest-product__slider owl-carousel">
                    @if ($hot && count($hot) >= 4)

                    @for ($i=0; $i < 2 ; $i++) @php $j=3; $k=0; @endphp <div class="latest-prdouct__slider__item">
                        @for ($k;$k<$j;$k++) <a href="{{route('product.detail',$latest[$k]->slug)}}" class="latest-product__item">
                            <div class="latest-product__item__pic">
                                <img src="@php
                $image=explode(',',$hot[$k]->photo);
                echo $image[0];
                @endphp" alt="{{$hot[$k]->title}}">
                            </div>
                            <div class="latest-product__item__text">
                                <h6>{{$hot[$k]->title}}</h6>
                                <span>{{number_format($hot[$k]->price)}}</span>
                            </div>
                            </a>
                            @endfor
                            @php
                            $j=6;
                            $k=3;
                            @endphp
                </div>
                @endfor
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="latest-product__text">
            <h4>Review Products</h4>
            @isset($reviewProducts)
            <div class="latest-product__slider owl-carousel">
            @if ($reviewProducts && count($reviewProducts) >= 4)

@for ($i=0; $i < 2 ; $i++) @php $j=3; $k=0; @endphp <div class="latest-prdouct__slider__item">
    @for ($k;$k<$j;$k++) <a href="{{route('product.detail',$reviewProducts[$k]->product_review->slug)}}" class="latest-product__item">
        <div class="latest-product__item__pic">
            <img src="@php
$image=explode(',',$reviewProducts[$k]->product_review->photo);
echo $image[0];
@endphp" alt="{{$reviewProducts[$k]->product_review->title}}">
        </div>
        <div class="latest-product__item__text">
            <h6>{{$reviewProducts[$k]->product_review->title}}</h6>
            <span>{{number_format($reviewProducts[$k]->product_review->price)}}</span>
        </div>
        </a>
        @endfor
        @php
        $j=6;
        $k=3;
        @endphp
</div>
@endfor
@endif
            </div>
            @endisset
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
            @isset($posts)
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{$post->photo}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <h5><a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a></h5>
                        <p>
                            {{$post->summary}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            @endisset

        </div>
    </div>
</section>
<!-- Blog Section End -->
@endsection

@section('banner')
@if(isset($mainBanner))
<div class="hero__item set-bg" data-setbg="{{$mainBanner->photo}}">
    <div class="hero__text">
        <span>OGANI SHOP</span>
        <h2>{{$mainBanner->title}} <br />100% Organic</h2>
        <p>{!!$mainBanner->description!!}</p>
        <a href="{{route('product.all')}}" class="primary-btn">SHOP NOW</a>
    </div>
</div>
@else
<div class="hero__item set-bg" data-setbg="{{asset('img/hero/banner.jpg')}}">
    <div class="hero__text">
        <span>FRUIT FRESH</span>
        <h2>Vegetable <br />100% Organic</h2>
        <p>Free Pickup and Delivery Available</p>
        <a href="{{route('product.all')}}" class="primary-btn">SHOP NOW</a>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .owl-carousel .owl-item img {
        display: block;
        width: 110px;
    }

    .blog__item__pic img {
        width: 370px;
        height: 266px;
        min-width: 100%;
    }
</style>
@endpush