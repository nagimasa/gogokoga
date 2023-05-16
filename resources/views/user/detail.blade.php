
@include('layouts.user')

<main class="index">



    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl category-title">カテゴリ別</h2>
            @if($detail->phototop)
                <img src="{{ secure_asset($detail->phototop->top_image_name) }}">
            @endif

            <section>
                <h2>基本情報</h2>
            <p>{{ $detail->service_name}}</p>
            <p>{{ $detail->tel}}</p>
            <p>{{ $detail->area->area_name}}</p>
            <p>{{ $detail->address}}</p>
            <p>{{ $detail->genre->genre_name}}</p>

            @if( $detail->sunday )
            {{ $detail->sunday}}
            @else
            登録されていません
            @endif

            @if( $detail->monday )
            {{ $detail->monday}}
            @else
            登録されていません
            @endif

            @if( $detail->tuesday )
            {{ $detail->tuesday}}
            @else
            登録されていません
            @endif

            @if( $detail->wednesday )
            {{ $detail->wednesday}}
            @else
            登録されていません
            @endif

            @if( $detail->thursday )
            {{ $detail->thursday}}
            @else
            登録されていません
            @endif

            @if( $detail->friday )
            {{ $detail->friday}}
            @else
            登録されていません
            @endif

            @if( $detail->saturday )
            {{ $detail->saturday}}
            @else
            登録されていません
            @endif

            @if( $detail->regular_holiday )
            {{ $detail->regular_holiday}}
            @else
            登録されていません
            @endif

            @if($detail)
                {{ $detail->seat}}
            @else
            登録されていません
            @endif

            @if($detail->payments)
                @foreach($detail->payments as $payment)
                    <p>{{ $payment->payment_name }}</p>
                @endforeach
            @endif

            <p>{{ $detail->parking}}</p>
            <p>{{ $detail->url}}</p>
            <p>{{ $detail->googlemap}}</p>
            @if($detail->comments)
                <p>{{ $detail->comments->comment}}</p>
            @endif

            {{-- @if($detail->photogall)
                @foreach($detail->photogall as $photogall)
                    <img src="{{ secure_asset($photogall->image_name) }}">
                @endforeach
            @endif --}}

        </section>


        </section>
        <p>ギャラリー</p>
        <div id="my_gal11">

            <!-- ここから写真部分。↓ -->
            
            <div class="base">
            
            <!-- ここからデータ。↓ -->
            <!-- title属性にオンマウスで表示されるツールチップ。不要ならば削除。 -->

            @if($detail->photogall)
                @foreach($detail->photogall as $photogall)
                    <img src="{{ secure_asset($photogall->image_name) }}">
                @endforeach
            @endif
            
            <!-- ここまでデータ。↑ -->
            
            </div>
            
            <!-- ここまで写真部分。↑ -->
            
            <!-- ここからギャラリー。↓ -->
            
            <div class="gallery">
            
            <!-- ここからサムネイル。↓ -->
            <!-- 写真部分の写真と同じ順番に。写真部分の写真を流用してもよい。 -->
            
            <img src="http://miyake.g2.xrea.com/img/3s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/5s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/6s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/9s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/10s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/11s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/1s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/18s.jpg" />
            <img src="http://miyake.g2.xrea.com/img/17s.jpg" />
            
            <!-- ここまでサムネイル。↑ -->
            
            </div>
            
            <!-- ここまでギャラリー。↑ -->
            
            </div>
    </article>



    <article class="bg-white mb-5 blog">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">ブログの更新</h2>
            <div class="blog-area p-4">
                <div class="blog-item pb-2 border-b border-gray-200">
                    {{-- ここに店舗カテゴリを判定してバッチを表示させる仕組みを入れる --}}
                    <h3 class="text-base mb-2">店舗名</h3>
                    <p class="text-xs mb-2">更新日時</p>
                    <p class="text-xs font-bold mb-2">スタッフコメント</p>
                </div>
            </div>
        </section>
    </article>


    <article class="bg-white mb-5 transpotation">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">交通</h2>
            <div class="flex flex-wrap justify-around">
                <a href="">
                    <div class="category-item mb-1">
                    </div>
                </a>
                <a href="">
                    <div class="category-item mb-1">
                    </div>
                </a>
            </div>
        </section>
    </article>




    <article class="bg-white mb-5 reqruit">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl reqruit-title">求人</h2>
            <div class="">
            </div>
        </section>
    </article>



    <article class="bg-white mb-5 typograph">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl typograph-title">51音順</h2>
            <div class="search-item p-4 border-b border-gray-200 flex justify-around">
                <div class="flex justify-around w-full">
                    {{-- controllerから「あ〜な」を表示させる --}}
                    <a href="">
                        あ
                    </a>
                    <a href="">
                        い
                    </a>
                    <a href="">
                        う
                    </a>
                    <a href="">
                        え
                    </a>
                    <a href="">
                        お
                    </a>
                </div>
                <div class="flex justify-around w-full border-l">
                    {{-- controllerから「は〜わ」を表示させる --}}
                    <a href="">
                        あ
                    </a>
                    <a href="">
                        い
                    </a>
                    <a href="">
                        う
                    </a>
                    <a href="">
                        え
                    </a>
                    <a href="">
                        お
                    </a>
                </div>
            </div>
        </section>
    </article>

</main>

</body>
{{-- <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body> --}}


<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/gallery.js') }}"></script>
</html>