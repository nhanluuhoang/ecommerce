@isset( $sitemap )
    <section class="sitemap">
        @switch( $sitemap['method'] )

            {{-- site map for search post --}}
            @case('search')
            <i class="sitemap" style="margin-left: 10px">{{ $sitemap['sitemap'] }}</i>
            @break

            {{-- site map for category product list post --}}
            @case('list')
            <div class="container">
                <a class="sitemap-old" href="{{ Helper::getUrl('') }}">Home</a>
                <img class="sitemap-icon" src="/img/Vector.png" alt="">
                @foreach( $sitemap['sitemap']['hierarchy'] as $ascendant)
                    <a class="sitemap-old"
                       href="{{ Helper::getUrl('/'.$ascendant->slug.'_c'.$ascendant->id) }}">
                        {{ $ascendant->name }}</a>
                    <img class="sitemap-icon" src="/img/Vector.png" alt="">
                @endforeach
                <a class="sitemap-new">{{ $sitemap['sitemap']['category']->name }}</a>
            </div>
            @break

            {{-- site map for product detail post --}}
            @case('product')
            <div class="container">
                <a class="sitemap-old" href="{{ Helper::getUrl('/') }}">Home</a>
                <img class="sitemap-icon" src="/img/Vector.png" alt="">
                @foreach( $sitemap['sitemap']['hierarchy'] as $ascendant)
                    <a class="sitemap-old" href="{{ Helper::getUrl('/'.$ascendant->slug.'_c'.$ascendant->id) }}">
                        {{ $ascendant->name }}
                    </a>
                    <img class="sitemap-icon" src="/img/Vector.png" alt="">
                @endforeach
                <a class="sitemap-new">{{ $sitemap['sitemap']['product'] }}</a>
            </div>
            @break

        @endswitch
    </section>
@endisset
