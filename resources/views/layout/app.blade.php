<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<html class="no-js" lang="vi">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async=""></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/loading.css">
    @yield('custom_head')
</head>
<body class="template-index tp_background tp_text_color">
    <div class="main-body">

        @include('layout.header')

        <div id="home-slider" class="tp_banner_main">
            <div id="homepage_slider" class="owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transition: all 0s ease 0s; width: 6960px; transform: translate3d(-2784px, 0px, 0px);">
                        @foreach($banners as $banner)
                            <div class="owl-item" style="width: 1392px;">
                                <div class="item">
                                    @if($banner->link)
                                        <a href="javascript:void(0);">
                                            <img
                                                class="owl-lazy"
                                                data-src="{{ $banner->src }}"
                                                src="{{ $banner->src }}"
                                                style="opacity: 1;"
                                            >
                                        </a>
                                    @else
                                        <a href="{{ $banner->link }}">
                                            <img
                                                class="owl-lazy"
                                                data-src="{{ $banner->src }}"
                                                src="{{ $banner->src }}"
                                                style="opacity: 1;"
                                            >
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @yield('main_content')

        @include('layout.footer')

        <div id="site-nav--mobile" class="site-nav style--sidebar show-cart">
            <div id="site-navigation" class="site-nav-container">
                <a href="/">
                    <img alt="Logo" src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/logo_1622448230_love-dear_black_2-20210129081444.png">
                </a>
                <div class="site-nav-container-last">
                    <p class="title title-menu-mobile">Menu</p>
                    <div class="main-navbar">
                        <nav class="primary-menu">
                            <ul class="menu-collection tp_menu accordion">
                                <li class="menu_cap1 ">
                                    <a href="/">Trang chủ</a>
                                </li>
                                @foreach($categories as $category)
                                    @if($category->children)
                                        <li class="menu_cap1">
                                            <a href="{{ $category->slug }}">
                                                {{ $category->title }}
                                            </a>
                                            <div class="icon-subnav">
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                            <ul class="menu_chir">
                                                @foreach($category->children as $child)
                                                    <li class="menu_cap1">
                                                        <a href="{{ $child->slug }}">
                                                            {{ $child->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="menu_cap1">
                                            <a href="{{ $category->slug }}">
                                                {{ $category->slug }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            @foreach($setting->shop_online as $shop)
                                @switch($shop['title'])
                                    @case('SHOPEE')
                                    <p>
                                        <a href="{{ $shop['link'] }}">
                                            <img style="width: 38px; height: 38px" alt="Shopee icon" src="data:image/png;base64,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" />
                                        </a>
                                        <a href="{{ $shop['link'] }}">Shopee</a>
                                    </p>
                                    @break
                                    @case('TIKI')
                                    <p>
                                        <a href="{{ $shop['link'] }}">
                                            <img style="width: 38px; height: 38px" alt="Tiki icon" src="data:image/png;base64,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" />
                                        </a>
                                        <a href="{{ $shop['link'] }}">Tiki</a>
                                    </p>
                                    @break
                                    @case('LAZADA')
                                    <p>
                                        <a href="{{ $shop['link'] }}">
                                            <img style="width: 38px; height: 38px" alt="Lazada icon" src="data:image/png;base64,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">&nbsp;&nbsp;
                                        </a>
                                        <a href="{{ $shop['link'] }}">Lazada</a>
                                    </p>
                                    @break
                                @endswitch
                            @endforeach
                            <p><a href="/ho-tro/chinh-sach-doi-tra">Chính sách đổi trả</a></p>
                            <p><a href="/ho-tro/dieu-khoan-mua-ban">Điều khoản mua bán</a></p>
                            <p><a href="/ho-tro/chinh-sach-giao-hang">Chính sách giao hàng</a></p>
                            <p><a href="/ho-tro/phuong-thuc-thanh-toan">Phương thức thanh toán</a></p>
                            <p><a href="/ho-tro/chinh-sach-bao-mat-thong-tin">Chính sách bảo mật thông tin</a></p>
                        </nav>
                    </div>
                    <div class="to-bottom-content">
                        <div class="site-social" aria-label="Follow us on social media">
                            @foreach($setting->social_network as $item)
                                @if($shop['link'])
                                    @switch($item['title'])
                                        @case('FACEBOOK')
                                            @if($item['link'])
                                                <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper facebook">
                                                    <span class="social-icon">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        @break
                                        @case('TWITTER')
                                            @if($item['link'])
                                                <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper twitter">
                                                    <span class="social-icon">
                                                        <i class="fab fa-twitter"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        @break
                                        @case('PINTEREST')
                                            @if($item['link'])
                                                <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper pinterest">
                                                    <span class="social-icon">
                                                        <i class="fab fa-pinterest"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        @break
                                        @case('GOOGLE')
                                            @if($item['link'])
                                                <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper google">
                                                    <span class="social-icon">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        @break
                                        @case('YOUTUBE')
                                            @if($item['link'])
                                            <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper youtube">
                                                <span class="social-icon">
                                                    <i class="fab fa-youtube"></i>
                                                </span>
                                            </a>
                                            @endif
                                        @break
                                        @case('INSTAGRAM')
                                            @if($item['link'])
                                                <a target="_blank" href="{{ $item['link'] }}" class="social-wrapper instagram">
                                                    <span class="social-icon">
                                                        <i class="fab fa-instagram"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        @break
                                    @endswitch
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="site-cart" class="site-nav-container" tabindex="-1"></div>
            <div id="site-search" class="site-nav-container" tabindex="-1">
                <div class="site-nav-container-last"><p class="title">Search</p>
                    <form class="search-header" action="/search">
                        <input class="txtSearch" type="search" name="q" placeholder="Tìm kiếm sản phẩm ...">
                        <button type="submit" class="btn btn-search" aria-label="Search">
                            <svg version="1.1" class="svg search" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 27" style="enable-background:new 0 0 24 27;" xml:space="preserve">
                                <path d="M10,2C4.5,2,0,6.5,0,12s4.5,10,10,10s10-4.5,10-10S15.5,2,10,2z M10,19c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S13.9,19,10,19z"></path>
                                <rect x="17" y="17" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.2844 19.5856)" width="4" height="8"></rect>
                            </svg>
                        </button>
                        <div id="searchFolding"></div>
                    </form>
                </div>
            </div>
            <button id="site-close-handle" class="site-close-handle" aria-label="Close sidebar" title="Close sidebar">
                <span class="hamburger-menu active" aria-hidden="true">
                    <span class="bar animate"></span>
                </span>
            </button>
        </div>

        <div id="site-overlay" class="site-overlay"></div>

        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_four"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_one"></div>
                </div>
            </div>
        </div>
    </div>


    {{--    <div class="fb-customerchat"--}}
    {{--         attribution=setup_tool--}}
    {{--         page_id="{{ config('page_id') }}">--}}
    {{--    </div>--}}
    {{--    <div id="loader"></div>--}}
    
    <script src="{{ asset('/js/common.js') }}"></script>
    <script src="{{ asset('/js/mobile.js') }}"></script>

    @yield('custom_scripts')

</body>
</html>
