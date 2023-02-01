<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の詳細
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">サービス名：{{ $service->service_name }}</h2>

                    <div class="p-6">
                        <div class="py-6">
                            <p class="font-bold">ジャンル</p>
                            <p>{{ $service->genre->genre_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">サービス名</p>
                            <p>{{ $service->service_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">カタカナ表記</p>
                            <p>{{ $service->service_name_kana }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">地域</p>
                            <p>{{ $service->area->area_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">メールアドレス</p>
                            <p>{{ $service->email }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">電話番号</p>
                            <p>{{ $service->tel }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">駐車場</p>
                            <p>{{ $service->parking }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">ホームページURL</p>
                            <p>{{ $service->url }}</p>
                        </div>
                        <hr>
                        
                        <div class="py-6">
                            <p class="font-bold">支払い方法</p>
                            @foreach($service->payments as $payment)
                            <p>{{ $payment->payment_name }}</p>
                            @endforeach
                        </div>
                        <hr>

                        <div class="py-6">
                            <p class="font-bold">googleMAP</p>
                            <p>{{ $service->googlemap }}</p>
                        </div>
                        <hr>
                        <div>
                            <h3 class="font-bold">営業日</h3>
                            <div class="py-6">
                                <p>月曜日</p>
                                <p>{{ $service->monday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>火曜日</p>
                                <p>{{ $service->tuesday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>水曜日</p>
                                <p>{{ $service->wednesday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>木曜日</p>
                                <p>{{ $service->thursday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>金曜日</p>
                                <p>{{ $service->friday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>土曜日</p>
                                <p>{{ $service->saturday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>日曜日</p>
                                <p>{{ $service->sunday }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p>祝日</p>
                                <p>{{ $service->regular_holiday }}</p>
                            </div>
                        </div>



                        {{-- ここから飲食店用 --}}
                        @if($service->genre_id == 1)
                        <div class="py-6">
                            <p class="font-bold">テイクアウト</p>
                            <p>{{ $service->takeout }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">座席</p>
                            <p>{{ $service->seat }}</p>
                        </div>
                        <hr>
                        @endif
                        {{-- ここまで飲食店用 --}}


                        {{-- ここからタクシー・代行用 --}}
                        @if($service->genre_id == 3)
                        <div class="py-6">
                            <p class="font-bold">初乗り料金</p>
                            <p>{{ $service->first_fee }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">追加料金</p>
                            <p>{{ $service->add_fee}}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">待機料金</p>
                            <p>{{ $service->stay_fee }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">キャンセル料金</p>
                            <p>{{ $service->cancel_fee }}</p>
                        </div>
                        <hr>
                        @endif
                        {{-- ここまでタクシー・代行用 --}}


                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.services.edit', ['service'=>$service->id])}}">
                                編集
                            </a>
                        </div>
                     </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
