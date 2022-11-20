@extends('layout.app')

@section('main_content')
<main role="main" id="shoppingcart">
    <section class="sitemap">
        <div class="container">
            <a class="sitemap-old" href="{{ Helper::getUrl('') }}">Home</a>
            <img class="sitemap-icon" src="/img/Vector.png" alt="">
            <a class="sitemap-new">Shopping Cart</a>
        </div>
    </section>

    <shopping-cart store="{{ Helper::getStoreName() }}"></shopping-cart>

</main>
@endsection