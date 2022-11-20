@extends('layout.app')

@section('main_content')
    <main role="main" id="product">
        @include('common.sitemap')
        <section class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-img">
                        <div class="product-button-img">
                            <img class="product-button active" src="{{ $product->thumbnails }}" alt="{{$product->title}}">

                            @if( $product->images->count() <= 4 )
                                @foreach( $product->images as $index => $image )
                                    <img class="product-button" src="{{ $image->thumbnails }}" alt="{{$product->title}}">
                                @endforeach
                            @else
                                @for( $i = 0; $i < 3; $i++)
                                    <img class="product-button" src="{{ $product->images[$i]->thumbnails }}" alt="{{$product->title}}">
                                @endfor
                                <div class="product-popup" data-toggle="modal" data-target="#exampleModal">
                                    <img src="{{ $product->images[3]->thumbnails }}" alt="">
                                    <h5 class="product-overlay-title">+{{ $product->images->count() - 3 }}</h5>
                                </div>
                            @endif
                        </div>
                        <div class="filter">
                            <img id="filter" src="{{ $product->thumbnails }}" alt="{{$product->title}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-category-title">
                        <h4 id="product-title" class="product-name"
                            data-product-id="{{ $product->id }}">{{ $product->title }}</h4>
                        <h5 class="product-category">{{ $product->category->name }}</h5>

                        @if(count($product->model_list) > 0)
                            @foreach( $product->model_list as $item )
                                @if( $product->discount_rate == 0 )
                                    <div class="product-detail-price d-none"
                                         data-model-id="{{ $item->id }}"
                                         data-variant-id="{{ implode(',', $item->variant_value_ids) }}"
                                         data-discount-rate="0">
                                        <h5 class="product-price" data-price="{{ $item->price }}">
                                            <u>đ </u>{{ number_format($item->price, 0, '', '.') }}
                                        </h5>
                                    </div>
                                @else
                                    <div class="product-detail-price d-none" data-model-id="{{ $item->id }}"
                                         data-variant-id="{{ implode(',', $item->variant_value_ids) }}"
                                         data-discount-rate="{{ $product->discount_rate }}">
                                        <h5 class="product-price"><u>đ </u>
                                            {{ number_format($item->price - ($item->price * $product->discount_rate / 100), 0, '', '.') }}
                                        </h5>
                                        <h5 class="product-saving">Bạn tiết kiệm :<u>đ </u>
                                            {{ number_format($item->price * $product->discount_rate / 100, 0, '', '.') }}
                                        </h5>
                                        <h5 class="product-existing" data-price="{{ $item->price - ($item->price * $product->discount_rate / 100) }}">Giá gốc :<u>đ </u>
                                            {{ number_format($item->price, 0, '', '.') }}
                                        </h5>
                                    </div>
                                @endif
                            @endforeach

                        @else
                            <h5 class="product-price" data-price="{{$product->price}}"><u>đ </u>{{ number_format($product->price - ($product->price * $product->discount_rate / 100), 0, '', '.') }}</h5>
                        @endif

                        @foreach( $product->option_values as $options )
                            <div class="product-variant-value">
                                <h5 class="product-type">{{ $options->option_name }}</h5>
                                <div class="product-type-box product-type-box-detail">
                                    @foreach($options->variant_values as $value)
                                        <button data-variant-value-id="{{ $value->id }}"
                                                class="product-button-type product-button-size">
                                            {{ $value->variant_value_name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <h5 class="product-description">Mô tả</h5>
                        <h5 class="product-description-content">
                            <span class="descrip-text-product descrip-line-clamp">{!! $product->descriptions !!}</span>
                            <a class="view-more">xem thêm</a>
                        </h5>
                        <div class="descrip-content-detail">
                            <table class="table-descrip">
                                <caption>Thông tin chi tiết</caption>
                                <tr>
                                    <td class="text-left">SKU</td>
                                    <td class="text-right">{{ $product->sku }}</td>
                                </tr>
                                @foreach( $product->details as $detail)
                                    <tr>
                                        <td class="text-left">{{ $detail->key }}</td>
                                        <td class="text-right">{{ $detail->value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <a class="collapse-infor">thu gọn</a>
                        <div class="product-cart-box">
                            <div class="product-cart-1">
                                <button id="product-amount-down">-</button>
                                <input id="product-amount" class="product-input" min="1" type="number" value="1"
                                       onkeyup="if (this.value<0)this.value=1"
                                       onblur="if(this.value<0)this.value=1"
                                       oninput="this.value = Math.round(this.value)"
                                >
                                <button id="product-amount-up">+</button>
                            </div>
                            <div class="product-cart-2">
                                <button id="add-cart-product"><img src="/img/add_to_cart.png"></button>
                            </div>
                            <div class="product-cart-3">
                                <button data-href="{{ Helper::getUrl('/checkout/cart') }}" id="checkout-product"
                                        class="product-cart-button">MUA NGAY
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h3 class="new-category-title">SẢN PHẨM LIÊN QUAN</h3>
                    </div>
                    <div class="row">
                        @foreach($similar as $item)
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="product-item-wrap pointer-hover">
                                    <div class="product-detail"
                                         data-product-url="{{ Helper::getUrl('/' . $item->slug . '_p' . $item->id) }}">

                                        <div class="img-item">
                                            <img src="{{ $item->thumb }}" alt="{{$item->title}}">
                                        </div>
                                        <div class="all-infor-card">
                                            <div class="infor-product">
                                                <p><b>{{$item->title}}</b></p>
                                                <p>{!! strip_tags($item->descriptions) !!}</p>
                                            </div>
                                            <div class="infor-sale">
                                                @if($product->discount_rate)
                                                    <span><del>₫ {{number_format($product->price, 0, '', '.')}}</del></span>
                                                @else
                                                    <span><del> </del></span>
                                                @endif

                                                <span><b>₫ {{number_format($product->price - ($product->price * $product->discount_rate / 100), 0, '', '.')}}</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-buy-product">
                                        <div class="product-open-model" data-product-id="{{$item->id}}">
                                            <span>THÊM VÀO GIỎ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
            @endforeach
        </section>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ảnh sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for($i = 0; $i < $product->images->count(); $i++)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"
                                        class="carousel-color active"></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ $product->thumbnails }}" alt="{{$product->title}}">
                                </div>

                                @for($i = 0; $i < $product->images->count(); $i++)
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ $product->images[$i]->thumbnails }}" alt="{{$product->title}}">
                                    </div>
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon carousel-color" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon carousel-color" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="overlay d-none"></div>

    <modal-product store="{{ Helper::getStoreName() }}"></modal-product>
@endsection

@section('custom_scripts')
    <script>
        const $product_button = $('.product-button');

        $product_button.click(function() {
          $product_button.removeClass('active');
          $('#filter').attr('src', $(this).attr('src'));
          $(this).addClass('active');
        });
    </script>
@endsection
