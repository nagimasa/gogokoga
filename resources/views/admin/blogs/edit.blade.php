<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $blog->blog_title }}編集
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $blog->blog_title }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.blogs.destroy', $blog->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $blog->blog_image_name) }}
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                        <div class=" pr-6 pt-6">
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

                            {{ Form::label('blog_title','ブログタイトル', ['class' => 'form-check-label']) }}
                            {{ Form::text('blog_title', $blog->blog_title, ['required' => 'required']) }}<br>

                            {{ Form::textarea('blog_text', $blog->blog_text, ['id' => 'ckeditor']) }}

                            <img src="{{ asset($blog->blog_image_name) }}" alt="">
                            {{ Form::file('blog_image_name', ) }}

                            <a href="{{ route('admin.blogs.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
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
