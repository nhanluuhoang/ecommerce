@extends('layout.app')

@section('main_content')
    <main role="main" id="shoppingcart">
        <section class="sitemap">
            <div class="container">
                <a class="sitemap-old" href="{{ Helper::getUrl('') }}">Home</a>
                <img class="sitemap-icon" src="/img/Vector.png" alt="">
                <a class="sitemap-old" href="{{ Helper::getUrl('/checkout/cart') }}">Shopping Cart</a>
                <img class="sitemap-icon" src="/img/Vector.png" alt="">
                <a class="sitemap-new">Checkout</a>
            </div>
        </section>

        <payment-component store="{{ Helper::getStoreName() }}"></payment-component>

    </main>
@endsection