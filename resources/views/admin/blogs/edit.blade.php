<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $blog->blog_title }}編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $blog->blog_title }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.blogs.destroy', $blog->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $blog->blog_image_name) }}
                            {{ Form::submit('削除', ['class' => 'text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="p-6">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach

                        {{ Form::open(['route' => ['admin.blogs.update', $blog->id],
                        'method'  => 'post',
                        'file'    => true,
                        'enctype' => 'multipart/form-data',
                        'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                        @csrf
                        @method('post')
                                
                            {{-- Form --}}
                            {{Form::hidden('service_id', $service->id )}}
                            {{Form::hidden('id', $blog->id )}}

                        <div class="block py-6 border-b">
                            {{ Form::label('blog_title','ブログタイトル', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('blog_title', $blog->blog_title, ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ',]) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('blog_text','ブログの本文', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::textarea('blog_text', $blog->blog_text, ['id' => 'ckeditor', 'class' => 'rounded w-full md:w-1/2 ',]) }}
                        </div>

                        <div class="block py-6 border-b">
                            <img src="{{ asset($blog->blog_image_name) }}" alt="">
                            {{ Form::file('blog_image_name', ) }}
                        </div>




                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                                <a href="{{ route('admin.blogs.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                {{ Form::submit('送信', ['class' => 'btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
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
