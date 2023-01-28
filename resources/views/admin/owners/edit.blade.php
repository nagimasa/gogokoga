<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $owner->owner_title }}編集
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $owner->name }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.owners.destroy', $service->id], 
                            'method'  => 'post' ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class=" pr-6 pt-6">
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.owners.update', $service->id],
                            'method'  => 'post' ]) }}
                            @csrf
                            @method('post')
                                
                                                    {{-- Form --}}
                        {{Form::hidden('service_id', $service->id )}}

                        {{ Form::label('name','オーナー名', ['class' => 'form-check-label']) }}
                        {{ Form::text('name',$owner->name, ['required' => 'required']) }}<br>

                        {{ Form::label('name_kana','カタカナ（オーナー名）', ['class' => 'form-check-label']) }}
                        {{ Form::text('name_kana',$owner->name_kana, ['required' => 'required']) }}<br>

                        {{ Form::label('owner_tel','担当者電話番号', ['class' => 'form-check-label']) }}
                        {{ Form::text('owner_tel',$owner->owner_tel, ['required' => 'required', 'placeholder' => '例）092-123-4567']) }}<br>

                        {{ Form::label('email','担当者メールアドレス', ['class' => 'form-check-label']) }}
                        {{ Form::text('email',$owner->email, ['required' => 'required', 'placeholder' => '例）owner@example.com']) }}<br>

                        {{ Form::label('password','パスワード', ['class' => 'form-check-label']) }}
                        {{ Form::text('password',$owner->password, ['placeholder' => 'パスワード']) }}<br>

                        {{ Form::label('another','備考欄', ['class' => 'form-check-label']) }}
                        {{ Form::textarea('another',$owner->another, ['placeholder' => '備考欄']) }}<br>


                        <a href="{{ route('admin.owners.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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
