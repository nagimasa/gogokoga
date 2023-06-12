<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の画像編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">画像の削除</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['owner.photogalls.destroy', ["photogalls" => $service->id, "photo" => $photo->id]], 
                            'method'  => 'post', 'file' => true,
                            'enctype' => 'multipart/form-data',
                            'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $photo->image_name) }}
                            {{ Form::submit('削除', ['class' => 'text-white bg-red-600 border-0 py-2 px-6 mb-2 bg-red-500 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>


                    <div class="p-6">
                        <div class="block py-6 border-b">
                        <img src="{{ asset($photo->image_name) }}">
                        </div>

                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                            <a href="{{ route('owner.photogalls.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
