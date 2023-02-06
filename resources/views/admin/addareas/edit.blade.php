<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の画像編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">画像の削除</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.addareas.destroy', $add_area->id], 
                            'method'  => 'post',
                            //  'file' => true,
                            // 'enctype' => 'multipart/form-data',
                            // 'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp'
                            ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('add_area_image', $add_area->add_area_image) }}
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>


                    <div class="p-6">
                        <div class="md:w-1/5 w-full p-2">
                        <img src="{{ asset($add_area->add_area_image) }}">
                        </div>

                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                            <a href="{{ route('admin.addareas.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
