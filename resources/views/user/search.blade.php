
@include('layouts.user')

<main class="search sm:max-w-3xl sm:m-auto">
    <div class="bg-white mb-5">
        <div class=" px-2 py-4 border-gray-300 border-b border-t">
            <div class="roudend mb-2">
                {{ Form::open(['route' => ['user.search'], 'method' => 'get']) }}
                <div class="flex mb-2">
                    <div class="roudend pr-2 w-1/2">
                        <select id="genre_id" name="genre_id" class="w-full">
                            <option value="">ジャンルを選択</option>
                            @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" roudend w-1/2">
                        <select id="area_id" name="area_id" class="w-full">
                            <option value="">地域を選択</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{ Form::text('keyword', old('keyword'), ['placeholder' => 'キーワードを入力','class' => 'form-control roudend w-full']) }}
            </div>
            {{ Form::submit('検索', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 hover:bg-blue-700 rounded w-full']) }}
            {{ Form::close() }}
        </div>
    </div>


    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl search-title sub-title">検索結果</h2>
            <div class="flex flex-wrap justify-start m-auto">
            @foreach($search_services as $service)
            <div class="item-pickup mb-10 mx-auto">
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
            </div>
        </section>
    </article>


</main>


@include('layouts.user-footer')