
@include('layouts.user')

<main class="category sm:max-w-3xl sm:m-auto">



    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl reqruit-title">求人情報</h2>
            <div class="flex flex-wrap justify-start m-auto">
            @foreach($reqruits as $reqruit)
            <div class="item-pickup mb-10 mx-auto">
                <a class="link-area" href="{{ route('user.detail', [$reqruit->service_id])}}">
                    <h3 class="text-xl p-4 text-white">{{ $reqruit->service->service_name }}</h3>
                    <div class="p-2">
                        <dl class="item-data">
                            <div class="flex py-2 border-b">
                                <dt class="font-bold w-32 text-right">雇用形態：</dt>
                                <dd class="w-full">{{ $reqruit->work_type}}</dd>
                            </div>
                            <div class="flex py-2 border-b">
                                <dt class="font-bold w-32 text-right">{{ $reqruit->fee_type }}：</dt>
                                <dd class="w-full">{{ $reqruit->fee}}</dd>
                            </div>
                            <div class="flex pl-2 pb-2 border-b item-data">
                                <dt class="font-bold w-32 text-right">勤務日数：</dt>
                                <dd class="w-full">{{ $reqruit->work_in_week}}</dd>
                            </div>
                            <div class="flex pl-2 pb-2 border-b item-data">
                                <dt class="font-bold w-32 text-right">勤務地：</dt>
                                <dd class="w-full">{{ $reqruit->address}}</dd>
                            </div>
                        </dl>
                    </div>
                </a>
                <dl class="item-data">
                </dl>
            </div>
            @endforeach
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