@extends('layout.app')

@section('custom_head')
    <style>
        .fancybox-skin {
            background: #fff;
        }

        .select-swap.color a:hover, .select-swap.color a.active {
            border: solid 2px #f48c42;
        }

        #q-variant-swatch-1 .select-swap.size a:hover {
            border: 1px solid #000;
        }

        #q-variant-swatch-1 .select-swap.size a.deactive {
            opacity: 0.3;
            pointer-events: none;
            background: #eee;
        }

        #q-variant-swatch-1 .select-swap.size a.active {
            background: #000;
            color: #fff;
        }

        .fancybox-btn-close {
            position: absolute;
            top: -18px;
            right: -18px;
            width: 28px;
            height: 28px;
            cursor: pointer;
            z-index: 8040;
            border: solid white 2px;
            border-radius: 20px;
            background: black;
            box-shadow: 1px 1px 1px 1px #888888;
        }

        .product-type {
            font-weight: 500;
            font-size: 12px;
            line-height: 16px;
            margin-top: 16px;
            color: #2b3d4b;
        }

        .product-button-type {
            border: none;
            margin-bottom: 10px;
            padding: 7px 16px;
            background: #edeff1;
            border-radius: 100px;
            margin-right: 5px;
            line-height: 18px;
            color: #46606e;
            font-size: 14px;
        }

        .option-value-active {
            background: #180825;
            color: #fff;
        }
    </style>
@endsection

@section('main_content')
    <div>
        <main class=" main-index">
            <h1 class="hidden">{{ config('app.name') }}</h1>
            <div class="wrapper-home-banner-top-new style-2">
                <div class="home-new tp_product_new">
                    <div class="wrapper-heading-home animation-tran active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
                                    <div class="site-animation">
                                        <h2>
                                            <a href="/product?show=new" class="tp_title">Sản phẩm mới</a>
                                        </h2>
                                        <div class="seperate-icon">
                                            <img
                                                data-sizes="auto"
                                                class="lazyautosizes lazyload"
                                                src="/image/lazyLoading.gif"
                                                data-src="/image/seperate-icon.png"
                                                sizes="117px"
                                            >
                                        </div>
                                        <div class="block-pding">
                                            <a href="/product?show=new" class="link-more tp_title">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-collection-1">
                        <div class="container-fluid">
                            <div class="clearfix content-product-list owl-carousel owl-loaded owl-drag"
                                 id="collection-one-slide">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1392px;">
                                        @foreach($newProducts as $newProduct)
                                        <div class="owl-item active" style="width: 318px; margin-right: 30px;">
                                            <div
                                                class="pro-loop animation-tran productItems product-ivt active"
                                                data-id="{{ $newProduct->id }}"
                                            >
                                                <div class="product-block product-resize site-animation">
                                                    <div
                                                        class="product-img image-resize"
                                                        data-product-id="{{ $newProduct->id }}"
                                                    >
                                                        <a href="/san-pham/{{ $newProduct->slug }}" title="{{ $newProduct->title }}">
                                                            <picture>
                                                                <source
                                                                    media="(max-width: 767px)"
                                                                    srcset="{{ $newProduct->thumbnails }}"
                                                                    sizes="245px"
                                                                >
                                                                <source
                                                                    media="(min-width: 768px)"
                                                                    srcset="{{ $newProduct->thumbnails }}"
                                                                    sizes="245px"
                                                                >
                                                                <img
                                                                    data-sizes="auto"
                                                                    class="img-loop img-default lazyautosizes ls-is-cached lazyload"
                                                                    alt="{{ $newProduct->title }}"
                                                                    src="{{ $newProduct->thumbnails }}"
                                                                    data-src="{{ $newProduct->thumbnails }}"
                                                                    data-img="{{ $newProduct->thumbnails }}"
                                                                    sizes="245px"
                                                                >
                                                            </picture>
                                                        </a>
                                                        <div class="button-add tp_button">
                                                            <button
                                                                title="Xem nhanh"
                                                                class="action quick-view"
                                                                data-id="{{ json_encode($newProduct->id) }}"
                                                            >
                                                                <span>Xem nhanh</span>
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    version="1.1"
                                                                    id="Capa_1"
                                                                    x="0px"
                                                                    y="0px"
                                                                    viewBox="0 0 59.2 59.2"
                                                                    style="enable-background:new 0 0 59.2 59.2;"
                                                                    xml:space="preserve"
                                                                >
                                                                    <g>
                                                                        <path d="M51.062,21.561c-11.889-11.889-31.232-11.889-43.121,0L0,29.501l8.138,8.138c5.944,5.944,13.752,8.917,21.561,8.917   s15.616-2.972,21.561-8.917l7.941-7.941L51.062,21.561z M49.845,36.225c-11.109,11.108-29.184,11.108-40.293,0l-6.724-6.724   l6.527-6.527c11.109-11.108,29.184-11.108,40.293,0l6.724,6.724L49.845,36.225z"></path>
                                                                        <path d="M28.572,21.57c-3.86,0-7,3.14-7,7c0,0.552,0.448,1,1,1s1-0.448,1-1c0-2.757,2.243-5,5-5c0.552,0,1-0.448,1-1   S29.125,21.57,28.572,21.57z"></path>
                                                                        <path d="M29.572,16.57c-7.168,0-13,5.832-13,13s5.832,13,13,13s13-5.832,13-13S36.741,16.57,29.572,16.57z M29.572,40.57   c-6.065,0-11-4.935-11-11s4.935-11,11-11s11,4.935,11,11S35.638,40.57,29.572,40.57z"></path>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <button
                                                                title="Mua ngay"
                                                                class="action add-to-cart"
                                                                onclick=""
                                                            >
                                                                <span>Mua ngay</span>
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    version="1.1" id="Capa_1" x="0px" y="0px"
                                                                    width="27.948px" height="27.948px"
                                                                    viewBox="0 0 27.948 27.948"
                                                                    style="enable-background:new 0 0 27.948 27.948;"
                                                                    xml:space="preserve">
                                                                    <g>
                                                                        <path d="M9.689,19.484h15.503v1.936H8.133L4.99,7.153h-4.3V5.218h5.854L9.689,19.484z M11.45,22.708   c-1.447,0-2.62,1.172-2.62,2.619c0,1.446,1.173,2.621,2.62,2.621c1.447,0,2.62-1.175,2.62-2.621   C14.07,23.88,12.897,22.708,11.45,22.708z M22.25,22.708c-1.445,0-2.619,1.172-2.619,2.619c0,1.446,1.174,2.621,2.619,2.621   c1.447,0,2.621-1.175,2.621-2.621C24.872,23.88,23.698,22.708,22.25,22.708z M10.668,18.035L8.37,6.133h3.76L20.463,0l3.729,5.064   l-0.161,1.069h3.227l-2.687,11.902H10.668z M23.584,5.477l-0.892,0.656h0.794L23.584,5.477z M13.038,6.132h1.958l-0.117-0.16   l0.379-0.279l0.324,0.439h0.48L15.57,5.463l0.38-0.279l0.697,0.948h0.544l-0.89-1.207l0.381-0.279l1.095,1.486h0.626l-1.301-1.768   l0.379-0.28l1.507,2.048h0.544l-1.697-2.308l0.379-0.278l1.902,2.586h1.668l1.639-1.205l-3.07-4.176L13.038,6.132z M21.75,5.305   l-2.088-2.839l-0.382,0.279l2.089,2.839L21.75,5.305z M21.02,5.845l-2.09-2.84l-0.379,0.279l2.092,2.839L21.02,5.845z"></path>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail clearfix">
                                                        <div class="box-pro-detail">
                                                            <h3 class="pro-name">
                                                                <a
                                                                    href="{{ $newProduct->slug }}"
                                                                    title="{{ $newProduct->title }}"
                                                                    class="tp_product_name"
                                                                >
                                                                    {{ $newProduct->title }}
                                                                </a>
                                                            </h3>
                                                            <div class="box-pro-prices">
                                                                <p class="overflowed pro-price ">
                                                                    <span class="tp_product_price">{{ $newProduct->price }} ₫</span>
                                                                </p>
                                                            </div>
                                                            <div class="action"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="home-product-best-seller" class="tp_product_betseller">
                    <div class="wrapper-heading-home animation-tran active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
                                    <div class="site-animation">
                                        <h2>
                                            <a href="/product" class="tp_title">Sản phẩm bán chạy</a>
                                        </h2>
                                        <div class="seperate-icon">
                                            <img data-sizes="auto" class="lazyautosizes ls-is-cached lazyload"
                                                 src="/image/lazyLoading.gif" data-src="/image/underline-ic.png"
                                                 sizes="117px">
                                        </div>
                                        <div class="block-pding">
                                            <a href="/product" class="link-more">Xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-collection-featured wrapper-collection-1">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="clearfix content-product-list list_clear2_pro ">
                                            @foreach($bestSaleProducts as $bestSaleProduct)
                                            <div
                                                class="col-md-6 col-sm-6 col-xs-6 pro-loop animation-tran productItems product-ivt active"
                                                data-id="{{ $bestSaleProduct->id }}"
                                            >
                                                <div class="product-block product-resize site-animation">
                                                    <div class="product-img image-resize" data-product-id="32948759">
                                                        <a
                                                            class="{{ $bestSaleProduct->quantity > 0 ? '' : "out-of-stock" }}"
                                                            title="{{$bestSaleProduct->title}}"
                                                            href="{{$bestSaleProduct->slug}}"
                                                        >
                                                            <picture>
                                                                <source
                                                                    media="(max-width: 767px)"
                                                                    srcset="{{$bestSaleProduct->thumbnails}}"
                                                                    sizes="318px"
                                                                >
                                                                <source
                                                                    media="(min-width: 768px)"
                                                                    srcset="{{$bestSaleProduct->thumbnails}}"
                                                                    sizes="318px"
                                                                >
                                                                <img
                                                                    class="img-loop img-default lazyautosizes ls-is-cached lazyload"
                                                                    src="{{$bestSaleProduct->thumbnails}}"
                                                                    data-img="{{$bestSaleProduct->thumbnails}}"
                                                                    data-sizes="auto"
                                                                    data-src="{{$bestSaleProduct->thumbnails}}"
                                                                    alt="{{$bestSaleProduct->title}}"
                                                                    sizes="318px">
                                                            </picture>
                                                            <picture
                                                                class="hover productHover32948759"
                                                                data-index="1"
                                                                data-first="1"
                                                                data-img=""
                                                            >
                                                            </picture>
                                                            @if ($bestSaleProduct->quantity < 0)
                                                                <span class="title-cart">HẾT HÀNG</span>
                                                            @endif
                                                        </a>
                                                        <div class="button-add tp_button">
                                                            <button
                                                                title="Xem nhanh"
                                                                class="action quick-view"
                                                                data-id="{{ json_encode($bestSaleProduct->id) }}"
                                                            >
                                                                <span>Xem nhanh</span>
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    version="1.1"
                                                                    id="Capa_1" x="0px" y="0px"
                                                                    viewBox="0 0 59.2 59.2"
                                                                    style="enable-background:new 0 0 59.2 59.2;"
                                                                     xml:space="preserve"
                                                                >
                                                                    <g>
                                                                        <path d="M51.062,21.561c-11.889-11.889-31.232-11.889-43.121,0L0,29.501l8.138,8.138c5.944,5.944,13.752,8.917,21.561,8.917   s15.616-2.972,21.561-8.917l7.941-7.941L51.062,21.561z M49.845,36.225c-11.109,11.108-29.184,11.108-40.293,0l-6.724-6.724   l6.527-6.527c11.109-11.108,29.184-11.108,40.293,0l6.724,6.724L49.845,36.225z"></path>
                                                                        <path d="M28.572,21.57c-3.86,0-7,3.14-7,7c0,0.552,0.448,1,1,1s1-0.448,1-1c0-2.757,2.243-5,5-5c0.552,0,1-0.448,1-1   S29.125,21.57,28.572,21.57z"></path>
                                                                        <path d="M29.572,16.57c-7.168,0-13,5.832-13,13s5.832,13,13,13s13-5.832,13-13S36.741,16.57,29.572,16.57z M29.572,40.57   c-6.065,0-11-4.935-11-11s4.935-11,11-11s11,4.935,11,11S35.638,40.57,29.572,40.57z"></path>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <button
                                                                title="Mua ngay"
                                                                class="action add-to-cart"
                                                                onclick=""
                                                            >
                                                                <span>Mua ngay</span>
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    version="1.1" id="Capa_1" x="0px" y="0px"
                                                                    width="27.948px" height="27.948px"
                                                                    viewBox="0 0 27.948 27.948"
                                                                    style="enable-background:new 0 0 27.948 27.948;"
                                                                     xml:space="preserve">
                                                                    <g>
                                                                        <path d="M9.689,19.484h15.503v1.936H8.133L4.99,7.153h-4.3V5.218h5.854L9.689,19.484z M11.45,22.708   c-1.447,0-2.62,1.172-2.62,2.619c0,1.446,1.173,2.621,2.62,2.621c1.447,0,2.62-1.175,2.62-2.621   C14.07,23.88,12.897,22.708,11.45,22.708z M22.25,22.708c-1.445,0-2.619,1.172-2.619,2.619c0,1.446,1.174,2.621,2.619,2.621   c1.447,0,2.621-1.175,2.621-2.621C24.872,23.88,23.698,22.708,22.25,22.708z M10.668,18.035L8.37,6.133h3.76L20.463,0l3.729,5.064   l-0.161,1.069h3.227l-2.687,11.902H10.668z M23.584,5.477l-0.892,0.656h0.794L23.584,5.477z M13.038,6.132h1.958l-0.117-0.16   l0.379-0.279l0.324,0.439h0.48L15.57,5.463l0.38-0.279l0.697,0.948h0.544l-0.89-1.207l0.381-0.279l1.095,1.486h0.626l-1.301-1.768   l0.379-0.28l1.507,2.048h0.544l-1.697-2.308l0.379-0.278l1.902,2.586h1.668l1.639-1.205l-3.07-4.176L13.038,6.132z M21.75,5.305   l-2.088-2.839l-0.382,0.279l2.089,2.839L21.75,5.305z M21.02,5.845l-2.09-2.84l-0.379,0.279l2.092,2.839L21.02,5.845z"></path>
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-detail clearfix">
                                                        <div class="box-pro-detail">
                                                            <h3 class="pro-name">
                                                                <a
                                                                    href="{{$bestSaleProduct->slug}}"
                                                                    title="{{$bestSaleProduct->title}}"
                                                                    class="tp_product_name"
                                                                >
                                                                    {{$bestSaleProduct->title}}
                                                                </a>
                                                            </h3>
                                                            <div class="box-pro-prices">
                                                                <p class="overflowed pro-price ">
                                                                    <span class="tp_product_price">{{$bestSaleProduct->price}} ₫</span>
                                                                </p>
                                                            </div>
                                                            <div class="action"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 hd-103846">
                                    <div class="collection-banner">
                                        <a href="javascript:void(0);" title="Sản phẩm bán chạy" class="effect">
                                            <img
                                                data-sizes="auto"
                                                class="lazyautosizes lazyload"
                                                src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/lovedear-banner.jpg"
                                                data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/lovedear-banner.jpg"
                                                alt="Banner bán chạy"
                                                sizes="666px"
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="animation-tran banner-instagram active">
            <div class="container-fluid">
                <div class="heading-title text-center">
                    <div class="wrapper-heading-home site-animation">
                        <h2>
                            <a href="https://www.instagram.com/lovedear.vn/">{{ config('app.name') }}</a>
                        </h2>
                        <div class="seperate-icon">
                            <img data-sizes="auto" class="lazyautosizes lazyload" src="/image/seperate-icon.png"
                                 data-src="/image/seperate-icon.png" sizes="117px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="instagram-list-img ">
                <ul class="list-img owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                             style="transition: all 0.25s ease 0s; width: 4207px; transform: translate3d(-1402px, 0px, 0px);">
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img
                                            alt="IG 05"
                                            data-sizes="auto"
                                            class="lazyautosizes lazyload"
                                            src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                            data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                            sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img
                                            alt="instagram 1"
                                            data-sizes="auto"
                                            class="lazyautosizes lazyload"
                                            src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                            data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                            sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img
                                            alt="instagram 02"
                                            data-sizes="auto"
                                            class="lazyautosizes lazyload"
                                            src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                            data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                            sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li><a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 03"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="IG 04"
                                             data-sizes="auto"
                                             class="lazyautosizes ls-is-cached lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item active" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="IG 05"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item active" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 1"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item active center" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 02"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item active" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 03"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item active" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="IG 04"
                                             data-sizes="auto"
                                             class="lazyautosizes ls-is-cached lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="IG 05"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-5.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 1"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 02"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-02.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="instagram 03"
                                             data-sizes="auto"
                                             class="lazyautosizes lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-03.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                            <div class="owl-item cloned" style="width: 270.4px; margin-right: 10px;">
                                <li>
                                    <a href="https://www.instagram.com/lovedear.vn/" target="_blank">
                                        <img alt="IG 04"
                                             data-sizes="auto"
                                             class="lazyautosizes ls-is-cached lazyload"
                                             src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             data-src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/bn/nen-thom-banner-ig-04.jpg"
                                             sizes="212px"
                                        >
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <button type="button" role="presentation" class="owl-prev">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <button type="button" role="presentation" class="owl-next">
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                    <div class="owl-dots disabled"></div>
                </ul>
            </div>
        </div>
    </div>

    <div
        id="fancybox"
        class="fancybox-overlay"
        style="width: auto; height: auto; background: rgba(158, 158, 158, 0.5); display: block;"
    >
    </div>
@endsection


@section('custom_scripts')
    <script src="/js/slider.js"></script>
    <script src="/js/getProduct.js"></script>
@endsection
