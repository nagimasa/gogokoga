
@include('layouts.user')

<main class="category sm:max-w-3xl sm:m-auto">



    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl category-title">カテゴリ別</h2>
            <div class="flex flex-wrap justify-start m-auto">
                @foreach($blogs as $blog)
                <div class="item-pickup mb-10 mx-auto w-full">
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
            </div>
        </section>
    </article>

</main>

@include('layouts.user-footer')