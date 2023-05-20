
@include('layouts.user')

<main class="category">



    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl category-title">カテゴリ別</h2>
            @foreach($services as $service)
            <div class="item-pickup mb-10">
                <a class="link-area" href="{{ route('user.detail', [$service->id])}}">
                    <h3 class="text-xl p-4 text-white">{{ $service->service_name }}</h3>
                    <div class="p-2">
                        @if($service->phototop)
                            <div class="img-box">
                                <img src="{{ secure_asset($service->phototop->top_image_name) }}">
                            </div>
                        @endif
                        <div class="py-2 border-b">
                            @if($service->coupon)
                                <span class="badge-coupon">クーポン</span>
                            @endif
                            @if($service->reqruit)
                                <span class="badge-reqruit">求人</span>
                            @endif
                        </div>
                        <dl class="item-data">
                            <div class="flex py-2 border-b">
                                <dt class="font-bold w-32 text-right">地域：</dt>
                                <dd class="w-full">{{ $service->area->area_name}}</dd>
                            </div>
                            <div class="flex py-2 border-b">
                            @if($service->comments)
                                <dt class="font-bold w-32 text-right">コメント：</dt>
                                <dd class="w-full">{{ $service->comments->comment}}</dd>
                            @endif
                            </div>
                            <div class="flex py-2 border-b ">
                                <dt class="font-bold w-32 text-right">住所：</dt>
                                <dd class="w-full">{{ $service->address}}</dd>
                            </div>
                        </dl>
                    </div>
                </a>
                <dl class="item-data">
                    <div class="flex pl-2 pb-2 border-b item-data">
                        <dt class="font-bold w-32 text-right">問い合わせ：</dt>
                        <dd class="w-full"><a href="tel:{{ $service->tel}}">{{ $service->tel }}</a></dd>
                    </div>
                </dl>
            </div>
            @endforeach
        </section>
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

@include('layouts.user-footer')