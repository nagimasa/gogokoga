<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のブログ投稿
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">ブログの投稿</h2>
                </div>
                    <div class="p-6">
                        
                        <div class="container">
                            <div class="card mt-3">
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                                
                                {{ Form::open(['route' => ['admin.blogs.store',  [$service->id]], 
                                'method'  => 'post', 'file' => true,
                                'enctype' => 'multipart/form-data',
                                'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                                @csrf
                                @method('post')
                                        
                                    {{-- Form --}}
                                    {{Form::hidden('service_id', $service->id )}}

                                <div class="block py-6 border-b">
                                    {{ Form::label('blog_title','ブログタイトル', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::text('blog_title',old('blog_title'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                                </div>

                                <div class="block py-6 border-b">
                                    {{ Form::label('blog_text','ブログの本文', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::textarea('blog_text',"", ['id' => 'ckeditor', 'class' => 'rounded w-full md:w-1/2 ']) }}
                                </div>

                                <div class="block py-6 border-b">
                                    <p class=" block font-bold">画像の掲載</p>
                                    {{ Form::file('blog_image_name', ) }}
                                </div>

                                <div class="pt-6">
                                    <div class="py-2 flex justify-between">
                                    <a href="{{ route('admin.blogs.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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
        </div>
    </div>

    

    <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>

</x-app-layout>

