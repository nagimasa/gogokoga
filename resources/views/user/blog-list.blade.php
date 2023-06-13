
@include('layouts.user')

<main class="category">



    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl category-title">カテゴリ別</h2>
            @foreach($blogs as $blog)
            <div class="item-pickup mb-10">
                <a class="link-area" href="{{ route('user.blog.show', [$blog->service_id, $blog->id])}}">
                    <h3 class="text-xl p-4 text-white">{{ $blog->blog_title }}</h3>
                    <div class="p-2">
                        <div class="py-2">
                        @if($blog->blog_text)
                            <div class="text-clip">
                                <p>{!! $blog->blog_text !!}</p>
                            </div>
                            <p class="created-at p-2 text-xs text-right">{{ $blog->created_at->format('y/m/d')}}</p>

                        @endif
                        </div>
                    </div>
                </a>
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



    {{-- <article class="bg-white mb-5 typograph">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl typograph-title">51音順</h2>
            <div class="search-item p-4 border-b border-gray-200 flex justify-around">
                <div class="flex justify-around w-full">
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
    </article> --}}

</main>

@include('layouts.user-footer')