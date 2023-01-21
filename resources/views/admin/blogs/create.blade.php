<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のブログ投稿
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">ブログの投稿</h2>

                    <div class="p-6">
                        
                        <div class="container">
                            <div class="card mt-3">
                                {{ Form::open(['route' => ['admin.blogs.store',  [$service->id]], 'method' => 'post', 'file' => true,]) }}
                                @csrf
                                @method('post')
                                    
                                {{-- Form --}}
                                    {{Form::hidden('service_id', $service->id )}}

                                    {{ Form::label('blog_title','ブログタイトル', ['class' => 'form-check-label']) }}
                                    {{ Form::text('blog_title',old('blog_title'), ['required' => 'required']) }}<br>

                                    {{ Form::textarea('blog_text',"", ['id' => 'ckeditor']) }}

                                    {{ Form::file('blog_image_name', ) }}

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

