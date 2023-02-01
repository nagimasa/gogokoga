<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の求人登録
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $service->service_name }}の求人登録</h2>
                    </div>
                    <div class="p-6">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach

                        {{ Form::open(['route' => ['admin.coupons.store', $service->id],
                        'method'  => 'post',
                        'file'    => true,
                        'enctype' => 'multipart/form-data',
                        'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                        @csrf
                        @method('post')
                            
                        {{-- Form --}}
                        {{Form::hidden('service_id', $service->id )}}

                        <div class="block py-6 border-b">
                        {{ Form::label('coupon_title','クーポンの見出し', ['class' => 'form-check-label block font-bold']) }}
                        {{ Form::text('coupon_title',old('coupon_title'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => '見出しを入力してください']) }}
                        </div>

                        <div class="block py-6 border-b">
                        {{ Form::label('coupon_text','クーポンの詳細', ['class' => 'form-check-label block font-bold']) }}
                        {{ Form::textarea('coupon_text',old('coupon_text'), ['required' => 'required', 'class' => ' block', 'id' => 'ckeditor', 'placeholder' => 'ここにクーポンの詳細情報を記入してください。']) }}
                        </div>


                        <div class="block py-6 border-b">
                        <p class="font-bold">公開状態</p>
                        {{ Form::radio('visualize', 1, true) }}
                        {{ Form::label('visualize', '公開', ['class' => 'pr-6']) }}
                        {{ Form::radio('visualize', 0) }}
                        {{ Form::label('visualize', '非公開') }}
                        </div>



                        <div class="block py-6 border-b">
                        <p class="font-bold">画像アップロード</p>
                        {{ Form::file('coupon_image', ) }}
                        </div>

                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                                <a href="{{ route('admin.coupons.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                {{ Form::submit('送信', ['class' => 'btn btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>

</x-app-layout>

