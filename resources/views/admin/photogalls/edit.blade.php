<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の画像編集
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">画像の削除</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.photogalls.destroy', $photo->id], 
                            'method'  => 'post', 'file' => true,
                            'enctype' => 'multipart/form-data',
                            'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $photo->image_name) }}
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>

                    <?php echo storage_path($photo->image_name); ?>

                    <div class="p-6">
                        <img src="{{ asset($photo->image_name) }}">
                    </div>

                    <hr>
                    <div class="py-6 flex justify-between">
                        <a href="{{ route('admin.photogalls.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                            戻る
                        </a>
                    </div>
                 </div>





                     </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
