<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            地域名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $area->area_name }}の編集</h2>

                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.areas.destroy', $area->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="p-6">
                            {{ Form::open(['route' => ['admin.areas.update', $area->id], 'method' => 'post']) }}
                        @csrf
                        @method('PUT')
                        <div class="py-6">
                            {{ Form::label('area_name','地域名')}}<br>
                            {{ Form::text('area_name', $area->area_name, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '地域名'])}}
                        </div>
                        <hr>
                        <div class="py-6">
                            {{ Form::label('area_name_kana','チイキメイ')}}<br>
                            {{ Form::text('area_name_kana',  $area->area_name_kana, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'カナ名'])}}
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.areas.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                     </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
