
@include('layouts.user')

<main class="blog-show sm:max-w-3xl sm:m-auto">
        <a class="call-btn" href="tel:{{ $detail->tel }}">
            <img src="{{ asset('storage/images/call-btn.svg')}}">
        </a>

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h1 class="text-2xl pb-10">{{ $detail->service->service_name}}のブログ</h1>
        </section>

        <section class="border-gray-300 blog-article">
            <h2 class="text-2xl p-4 text-white title">{{ $detail->blog_title}}</h2>
            <div class="p-2">
            <p>{!! $detail->blog_text !!}</p>
            </div>
            @if($detail->blog_image_name)
                <img class="p-2" src="{{ secure_asset($detail->blog_image_name) }}">
            @endif
            <p class="created-at p-2 text-xs text-right">{{ $detail->created_at->format('y/m/d')}}</p>
        </section>
    </article>







</main>


@include('layouts.user-footer')