
@include('layouts.user')

<main class="detail sm:max-w-3xl sm:m-auto">

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300 m-auto">
            <h1 class="text-2xl mb-10">お問い合わせ<span class="subtitle text-xs font-bold">CONTACT</span></h1>
            <div class="border rounded p-4">
                <p>お問い合わせありがとうございました。<br>
                    ５営業日以内に返信いたします。</p>
            </div>
        </section>
        <a href="{{ Route('user.index')}}">TOP</a>
    </article>

</main>

@include('layouts.user-footer')