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
                    <h2 class="text-xl bg-blue-600 text-white p-6">サービス名の登録</h2>

                    <div class="p-6">
                        <h3>基本設定</h3>
                            {{ Form::open(['route' => ['owner.services.store'], 'method' => 'post']) }}
                        @csrf
                        @method('post')
                        <div class="py-6">
                            {{ Form::radio('visualize', 1, true, ['class' => 'form-control']) }}
                            {{ Form::label('service_name','表示', ['class' => ' font-bold'])}}

                            {{ Form::radio('visualize', 0, false, ['class' => 'form-control']) }}
                            {{ Form::label('service_name','非表示', ['class' => ' font-bold'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('genre_id','ジャンル', ['class' => ' font-bold'])}}<br>
                            {{ Form::select('genre_id', $genres, ['class' => 'form-control']) }}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('area_id','地域名', ['class' => ' font-bold'])}}<br>
                            {{ Form::select('area_id', $areas, ['class' => 'form-control']) }}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('service_name','サービス名', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('service_name', old('service_name'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'サービス名'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('service_name_kana','カタカナ表記', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('service_name_kana', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'カナ名'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('tel','電話番号', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('tel', old('tel'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '半角数字で入力してください'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('email','メールアドレス', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('email', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('address','所在地', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('address', old('address'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('parking','駐車場', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('parking', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '2台'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('googlemap','googleMAP', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('googlemap', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'test@test.com'])}}
                        </div>
                        <hr>

                        <div class="py-6">
                            {{ Form::label('url','ホームページのURL', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('url', old('tel'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '古賀市を含めて入力してください'])}}
                        </div>
                        <hr>

                        <div class="py-6">
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
                        <hr>

                        <div class="py-6">
                            {{ Form::label('another','備考欄', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('another', old('another'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '自由記入欄です。'])}}
                        </div>
                        <hr>

                        {{-- ここから営業時間設定 --}}

                        <div class="py-6">
                            <h3>営業時間</h3>
                            <div class="py-6">
                            {{ Form::label('monday','月曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('monday', old('monday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                            </div>
                            <div class="py-6">
                            {{ Form::label('tuesday','火曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('tuesday', old('tuesday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('wednesday','水曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('wednesday', old('wednesday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('thursday','木曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('thursday', old('thursday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('friday','金曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('friday', old('friday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('saturday','土曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('saturday', old('saturday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('sunday','日曜日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('sunday', old('sunday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}

                            </div>
                            <div class="py-6">
                            {{ Form::label('regular_holiday','祝日', ['class' => ' font-bold'])}}<br>
                            {{ Form::text('regular_holiday', old('regular_holiday'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '9:00-17:00'])}}
                            </div>
                            <hr>
                        {{-- ここまで営業時間設定 --}}
                        




                        {{-- ここから飲食店 --}}
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h3 class="text-xl text-blue-600 p-6">飲食店用</h3>
                            <div class="py-6">
                                {{ Form::label('seat','座席数', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('seat', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '2台'])}}
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
                                {{ Form::text('first_fee', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：3kmまで1,500円'])}}
                            </div>
                            <hr>
                            <div class="py-6">
                                {{ Form::label('add_fee','追加料金', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('add_fee', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：500円/km'])}}
                            </div>
                            <hr>
                            <div class="py-6">
                                {{ Form::label('cancel_fee','キャンセル料金', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('cancel_fee', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：1,000円'])}}
                            </div>
                            <hr>
                            <div class="py-6">
                                {{ Form::label('stay_fee','待機料金', ['class' => ' font-bold'])}}<br>
                                {{ Form::text('stay_fee', null, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '例：10分につき500円'])}}
                            </div>
                            <hr>

                        </div>
                        {{-- ここまでタクシー/代行 --}}

                        <div class="py-6 flex justify-between">
                            <a href="{{ route('owner.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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
</x-app-layout>
