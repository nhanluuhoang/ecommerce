<header id="site-header" class="main-header tp_menu scroll-menu">
    <div class="container-fluid">
        <div class="header-top wrap-flex-align">
            <div class="wrap-logo hidden-xs hidden-sm">
                <a href="javascript:void(0);" title="Logo">
                    <img style="max-width: 200px" alt="Logo" src="{{$setting->company_logo}}">
                </a>
            </div>
            <div id="nav-menu" class="hidden-sm hidden-xs">
                <nav role="navigation" class="main-nav-menu">
                    <ul class="menu__list menu__list--top tp_menu">
                        <li class="menu__item mega tp_menu_item">
                            <a itemprop="url" href="/" title="Trang chủ" class="menu__link tp_menu_item menu_29149">
                                Trang chủ
                            </a>
                        </li>
                        @foreach($categories as $category)
                            @if($category->children)
                                <li itemprop="name" class="menu__item mega tp_menu_item">
                                    <a itemprop="url" href="{{ $category->slug }}" title="{{ $category->title }}" class="menu__link tp_menu_item menu_29149">
                                        {{ $category->title }}
                                    </a>
                                    <div class="menu__content">
                                        <div class="container-fluid">
                                            <div class="menu-flex">
                                                <ul class="menu__list menu__list--second">
                                                    @foreach($category->children as $child)
                                                        <li class="menu__item third">
                                                            <a href="{{ $child->slug }}" class="menu__link">
                                                                {{ $child->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li itemprop="name" class="menu__item mega tp_menu_item ">
                                    <a itemprop="url" href="{{ $category->slug }}" title="{{ $category->title }}" class="menu__link tp_menu_item menu_29148">
                                        {{ $category->slug }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="header-wrap-icon">
                <div class="search-box hidden-sm hidden-xs wpo-wrapper-search hidden">
                    <form id="searchauto" action="/search" class="searchform searchform-categoris ultimate-search navbar-form">
                        <div class="wpo-search-inner form-group">
                            <input id="inputSearchAuto" name="q" maxlength="40" autocomplete="off" class="searchinput input-search search-input" type="text" size="20" placeholder="Bạn cần tìm gì...">
                        </div>
                        <button type="submit" class="icon-search btn" id="search-header-btn">
                            <span class="search-menu" aria-hidden="true">
                                <img src="/image/icon-header-3.png" alt="cart">
                            </span>
                        </button>
                    </form>
                </div>
                <div class="group-icon">
                    <div class="col-sm-12 col-xs-12 hidden-lg hidden-md">
                        <div class="row">
                            <div class="col-sm-4 col-xs-3 group-icon iconLogo">
                                <span id="site-menu-handle" class="hamburger-menu hidden-lg hidden-md" aria-hidden="true">
                                    <span class="bar"></span>
                                </span>
                            </div>
                            <div class="col-sm-4 col-xs-5 logo-xs">
                                <div class="wrap-logo">
                                    <a href="/" title="Logo">
                                        <img style="max-width: 130px" alt="Logo" src="https://img.cdn.vncdn.io/nvn/ncdn/store3/101249/logo_1622448230_love-dear_black_2-20210129081444.png">
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-4 group-icon iconSearch">
                                <span id="site-search-handle" class="icon-search" aria-label="Open search" title="Tìm kiếm">
                                    <a href="/search">
                                        <span class="search-menu" aria-hidden="true">
                                            <img src="/image/icon-header-3.png" alt="search">
                                        </span>
                                    </a>
                                </span>
                                <span id="site-account-handle" class="icon-account" aria-label="Open account" title="Tài khoản">
                                    <a href="/user/signin" title="Đăng nhập">
                                        <span class="account-menu" aria-hidden="true">
                                            <img src="/image/icon-header-1.png" alt="cart">
                                        </span>
                                    </a>
                                </span>
                                <span id="site-cart-handle" class="icon-cart" aria-label="Open cart" title="Giỏ hàng">
                                    <a href="/cart">
                                        <span class="cart-menu" aria-hidden="true">
                                            <img src="/image/icon-header-2.png" alt="cart">
                                            <span class="count-holder">
                                                <span class="count">0</span>
                                            </span>
                                        </span>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-xs hidden-sm group-icon">
                        <span id="site-search-handle" class="icon-search" aria-label="Open search" title="Tìm kiếm">
                            <a href="/search">
                            <span class="search-menu" aria-hidden="true">
                                <img src="/image/icon-header-3.png" alt="search">
                            </span>
                            </a>
                        </span>
                        <span id="site-account-handle" class="icon-account" aria-label="Open account" title="Tài khoản">
                            <a href="/user/signin" title="Đăng nhập">
                                <span class="account-menu" aria-hidden="true">
                                    <img src="/image/icon-header-1.png" alt="cart">
                                </span>
                            </a>
                        </span>
                        <span id="site-cart-handle" class="icon-cart" aria-label="Open cart" title="Giỏ hàng">
                            <a href="/cart">
                                <span class="cart-menu" aria-hidden="true">
                                    <img src="/image/icon-header-2.png" alt="cart">
                                    <span class="count-holder">
                                        <span class="count">0</span>
                                    </span>
                                </span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
