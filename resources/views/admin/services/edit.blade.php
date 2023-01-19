<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            サービス名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $service->service_name }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.services.destroy', $service->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                        <div class="p-6">
                            <h3>基本設定</h3>
                                {{ Form::open(['route' => ['admin.services.update', $service->id], 'method' => 'post']) }}
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
                                {{ Form::label('service_name','ジャンル', ['class' => ' font-bold'])}}<br>
                                {{ Form::select('genre_id', $genres, $service->genre_id,['class' => 'form-control']) }}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('service_name','地域名', ['class' => ' font-bold'])}}<br>
                                {{ Form::select('area_id', $areas, $service->area_id, ['class' => 'form-control']) }}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('service_name','サービス名', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('service_name', $service->service_name, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'サービス名'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('service_name_kana','カタカナ表記', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('service_name_kana', $service->service_name_kana, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'カナ名'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('tel','電話番号', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('tel', $service->tel, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '半角数字で入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('email','メールアドレス', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('email',$service->email, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('address','所在地', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('address', $service->address, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('parking','駐車場', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('parking', $service->parking, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '2台'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('googlemap','googleMAP', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('googlemap', $service->googlemap, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                {{ Form::label('url','ホームページのURL', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('url', $service->url, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                            </div>
                            <hr>
    
                            <div class="py-6">
                                <h4 class="font-bold">支払い方法</h4>
                                <div class="flex">
                                    @foreach($payments as $key => $val)
                                    <div class="p-6">
                                        {{ Form::checkbox('payments[]', $key, in_array($key, $service->payments->pluck('id')->toArray())), ['id' => 'payment'.$key] }}
                                        {{ Form::label('payment'.$key, $val, ['class' => ' font-bold']) }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
    
                            {{-- <div class="py-6">
                                <h4 class="font-bold">支払い方法</h4>
                                <div class="flex">
                                    @foreach($payments as $key => $val)
                                    <div class="p-6">
                                        {{ Form::checkbox('payments[]', $key), ['id' => 'payment'.$key] }}
                                        {{ Form::label('payment'.$key, $val, ['class' => ' font-bold']) }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr> --}}
    
                            <div class="py-6">
                                {{ Form::label('another','備考欄', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('another', $service->payment, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '自由記入欄です。'])}}
                            </div>
                            <hr>
    
                            {{-- ここから営業時間設定 --}}
    
                            <div class="py-6">
                                <h3>営業時間</h3>
                                <div class="py-6">
                                {{ Form::label('monday','月曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('monday', $service->monday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                                </div>
                                <div class="py-6">
                                {{ Form::label('tuesday','火曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('tuesday', $service->tuesday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('wednesday','水曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('wednesday', $service->wednesday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('thursday','木曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('thursday', $service->thursday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('friday','金曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('friday', $service->friday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('saturday','土曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('saturday', $service->saturday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('sunday','日曜日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('sunday', $service->sunday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
    
                                </div>
                                <div class="py-6">
                                {{ Form::label('regular_holiday','祝日', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('regular_holiday', $service->regular_holiday, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                                </div>
                                <hr>
                            {{-- ここまで営業時間設定 --}}
                            
    
    
    
    
                            {{-- ここから飲食店 --}}
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
                            {{-- ここまで飲食店 --}}
    
    
    
                            {{-- ここからタクシー/代行 --}}
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
                            {{-- ここまでタクシー/代行 --}}
    
                            <div class="py-6 flex justify-between">
                                <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                {{ Form::submit('送信', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                                {{ Form::close() }}
                            </div>
                         </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
