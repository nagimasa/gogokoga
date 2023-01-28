<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $coupon->coupon_title }}編集
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $coupon->coupon_title }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.coupons.destroy', $service->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $coupon->coupon_image) }}
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class=" pr-6 pt-6">
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.coupons.update', $service->id],
                            'method'  => 'post',
                            'file'    => true,
                            'enctype' => 'multipart/form-data',
                            'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                            @csrf
                            @method('post')
                                
                            {{-- Form --}}
                            {{Form::hidden('service_id', $service->id )}}
                            {{Form::hidden('id', $coupon->id )}}
    
                            {{ Form::label('coupon_title','クーポンの見出し', ['class' => 'form-check-label']) }}
                            {{ Form::text('coupon_title',$coupon->coupon_title, ['required' => 'required']) }}<br>
    
                            {{ Form::label('coupon_text','クーポンの詳細', ['class' => 'form-check-label']) }}
                            {{ Form::textarea('coupon_text',$coupon->coupon_title, ['id' => 'ckeditor', 'placeholder' => 'ここにクーポンの詳細情報を記入してください。']) }}
    
    
                            {{ Form::radio('visualize', 1, true) }}
                            {{ Form::label('visualize', '公開') }}
                            {{ Form::radio('visualize', 0) }}
                            {{ Form::label('visualize', '非公開') }}
    
                            @if($coupon->coupon_image == True)
                            <img src="{{ asset($coupon->coupon_image) }}">
                            @else
                            画像は登録されていません。
                            @endif
                            {{ Form::file('coupon_image', ) }}
    
                            <a href="{{ route('admin.coupons.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
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
