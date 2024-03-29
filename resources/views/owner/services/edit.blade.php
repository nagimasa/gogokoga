<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            サービス名
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $service->service_name }}の編集</h2>
                    </div>
                        <div class="p-6">
                            <h3>基本設定</h3>
                                {{ Form::open(['route' => ['owner.services.update', $service->id], 'method' => 'post']) }}
                            @csrf
                            @method('PUT')
                            <div class="py-6">
                                {{ Form::radio('visualize', 1, true, ['class' => 'form-control']) }}
                                {{ Form::label('service_name','表示', ['class' => ' font-bold'])}}
    
                                {{ Form::radio('visualize', 0, false, ['class' => 'form-control']) }}
                                {{ Form::label('service_name','非表示', ['class' => ' font-bold'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                <h4 class="font-bold">ジャンル</h4>
                                <p>{{ $service->genre->genre_name }}</p>
                                {{ Form::hidden('genre_id', $service->genre_id) }}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                <h4 class="font-bold">地域名</h4>
                                <p>{{ $service->area->area_name }}</p>
                                {{ Form::hidden('area_id', $service->area_id) }}
                            </div>
                            <hr>
    
                            <div class="block py-6">
                                <h4 class="font-bold">サービス名または会社名</h4>
                                <p>{{ $service->service_name }}</p>
                                {{ Form::hidden('service_name', $service->service_name) }}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                <h4 class="font-bold">カタカナ（サービス名または会社名）</h4>
                                <p>{{ $service->service_name_kana }}</p>
                                {{ Form::hidden('service_name_kana', $service->service_name_kana) }}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('tel','電話番号', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('tel', $service->tel, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '半角数字で入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('email','メールアドレス', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('email',$service->email, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('address','所在地', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('address', $service->address, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('parking','駐車場', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('parking', $service->parking, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '2台'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('googlemap','googleMAP', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('googlemap', $service->googlemap, ['class' => 'w-full md:w-1/2 2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('url','ホームページのURL', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('url', $service->url, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                <h4 class="font-bold">支払い方法</h4>
                                <div class="flex">
                                    <div class="">
                                        @foreach($payments as $key => $val)
                                            {{ Form::checkbox('payments[]', $key, in_array($key, $service->payments->pluck('id')->toArray())), ['id' => 'payment'.$key] }}
                                            {{ Form::label('payment'.$key, $val, ['class' => ' font-bold pr-4']) }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>


                            {{-- <div>
                                @foreach($genre_with_tag as $genre)
                                <div class="pt-6">
                                <p>{{ $genre->genre_name }}</p>
                                    @foreach($genre->tags as $key => $val)
                                    {{ Form::checkbox('tags[]', $val->id, in_array($val->id, $service->tags->pluck('id')->toArray())), ['id' => 'tag'.$key] }}
                                    {{ Form::label('tag'.$key, $val->tag_name, ['class' => ' font-bold pr-4']) }}
                                    @endforeach
                                </div>
                                @endforeach
                            </div> --}}


                            <div class="py-6">
                                <h4 class="font-bold">タグ設定</h4>
                                @foreach($tags as $key => $val)
                                    {{ Form::checkbox('tags[]', $val->id, in_array($val->id, $service->tags->pluck('id')->toArray())), ['id' => 'tag'.$key] }}
                                    {{ Form::label('tag'.$key, $val->tag_name, ['class' => ' font-bold pr-4']) }}
                                @endforeach
                            </div>

                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('another','備考欄', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('another', $service->payment, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '自由記入欄です。'])}}
                            </div>
                            <hr>
    
                            {{-- ここから営業時間設定 --}}
    
                            <div class="py-6">
                                <h3>営業時間</h3>
                                <div class="py-6">
                                {{ Form::label('monday','月曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('monday', $service->monday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                                </div>
                                <div class="py-6">
                                {{ Form::label('tuesday','火曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('tuesday', $service->tuesday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('wednesday','水曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('wednesday', $service->wednesday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('thursday','木曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('thursday', $service->thursday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('friday','金曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('friday', $service->friday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('saturday','土曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('saturday', $service->saturday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('sunday','日曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('sunday', $service->sunday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('regular_holiday','祝日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('regular_holiday', $service->regular_holiday, ['class' => 'w-full md:w-1/2  rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                                </div>
                                <hr>
                            {{-- ここまで営業時間設定 --}}
                            
    
    
    
    
                            {{-- ここから飲食店 --}}
                            @if($service->genre->id == 1)
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <h3 class="text-xl text-blue-600 p-6">飲食店用</h3>
                                <div class="py-6">
                                    {{ Form::label('seat','座席数', ['class' => ' font-bold'])}}<br>
                                    {{ Form::text('seat', $service->seat, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '2台'])}}
                                </div>
                                <hr>
                                <div class="py-6">
                                    <h4>テイクアウト</h4>
                                    {{ Form::radio('takeout', 1, true, ['class' => 'form-control']) }}
                                    {{ Form::label('takeout','あり', ['class' => ' font-bold'])}}
    
                                    {{ Form::radio('takeout', 0, false, ['class' => 'form-control']) }}
                                    {{ Form::label('takeout','なし', ['class' => ' font-bold'])}}
                                </div>
                                <hr>
                            </div>
                            @endif
                            {{-- ここまで飲食店 --}}
    
    
    
                            {{-- ここからタクシー/代行 --}}
                            @if($service->genre->id == 10 || $service->genre->id == 11)
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <h3 class="text-xl text-blue-600 p-6">タクシー・運転代行用</h3>
                                <div class="py-6">
                                    {{ Form::label('first_fee','初乗り料金', ['class' => ' font-bold'])}}<br>
                                    {{ Form::text('first_fee', $service->first_fee, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：3kmまで1,500円'])}}
                                </div>
                                <hr>
                                <div class="py-6">
                                    {{ Form::label('add_fee','追加料金', ['class' => ' font-bold'])}}<br>
                                    {{ Form::text('add_fee', $service->add_fee, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：500円/km'])}}
                                </div>
                                <hr>
                                <div class="py-6">
                                    {{ Form::label('cancel_fee','キャンセル料金', ['class' => ' font-bold'])}}<br>
                                    {{ Form::text('cancel_fee', $service->cancel_fee, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：1,000円'])}}
                                </div>
                                <hr>
                                <div class="py-6">
                                    {{ Form::label('stay_fee','待機料金', ['class' => ' font-bold'])}}<br>
                                    {{ Form::text('stay_fee', $service->stay_fee, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：10分につき500円'])}}
                                </div>
                                <hr>

                            </div>
                            @endif
                            {{-- ここまでタクシー/代行 --}}
    
                            <div class="py-6 flex justify-between">
                                <a href="{{ route('owner.services.show', ['service'=>$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                {{ Form::submit('送信', ['class' => 'text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                                {{ Form::close() }}
                            </div>
                         </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
