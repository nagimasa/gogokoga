<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $reqruit->reqruit_title }}編集
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $reqruit->reqruit_title }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.reqruits.destroy', $service->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class=" pr-6 pt-6">
                        {{ Form::open(['route' => ['admin.reqruits.update', $reqruit->id],
                        'method'  => 'post',
                        'file'    => true,
                        'enctype' => 'multipart/form-data',
                        'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                        @csrf
                        @method('post')
                            
                        {{-- Form --}}
                        {{Form::hidden('service_id', $service->id )}}
                        {{Form::hidden('id', $reqruit->id )}}

                        {{ Form::label('reqruit_title','ブログタイトル', ['class' => 'form-check-label']) }}
                        {{ Form::text('reqruit_title', $reqruit->reqruit_title, ['required' => 'required']) }}<br>

                        {{ Form::textarea('reqruit_text', $reqruit->reqruit_text, ['id' => 'ckeditor']) }}

                        <img src="{{ asset($reqruit->reqruit_image_name) }}" alt="">
                        {{ Form::file('reqruit_image_name', ) }}

                        <a href="{{ route('admin.reqruits.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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
