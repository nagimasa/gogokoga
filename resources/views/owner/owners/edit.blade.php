<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $owner->owner_title }}編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $owner->name }}の編集</h2>
                        {{-- <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['owner.owners.destroy', $service->id], 
                            'method'  => 'post' ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div> --}}
                    </div>
                    <div class="p-6">

                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            
                            {{ Form::open(['route' => ['owner.owners.update', $service->id],
                            'method'  => 'post' ]) }}
                            @csrf
                            @method('patch')
                                
                                                    {{-- Form --}}
                        {{Form::hidden('service_id', $service->id )}}


                        <div class="block py-6 border-b">
                            {{ Form::label('name','担当者名', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('name',$owner->name, ['required' => 'required', 'class' => 'rounded w-full md:w-1/2']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('name_kana','カタカナ（担当者名）', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('name_kana',$owner->name_kana, ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('owner_tel','担当者電話番号', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('owner_tel',$owner->owner_tel, ['required' => 'required', 'placeholder' => '例）092-123-4567', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('email','担当者メールアドレス', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('email',$owner->email, ['required' => 'required', 'placeholder' => '例）owner@example.com', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('password','パスワード', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('password','', ['placeholder' => 'パスワード', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('another','備考欄', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::textarea('another',$owner->another, ['placeholder' => '備考欄', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>



                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                                <a href="{{ route('owner.owners.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                {{ Form::submit('送信', ['class' => 'btn btn-primary btn btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
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
