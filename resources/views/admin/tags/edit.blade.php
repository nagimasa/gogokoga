<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            タグ
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">タグ：{{ $tag->tag_name }}の編集</h2>

                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['admin.tags.destroy', $tag->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="p-6">
                            {{ Form::open(['route' => ['admin.tags.update', $tag->id], 'method' => 'post']) }}
                        @csrf
                        @method('PUT')
                        <div class="py-6">
                            {{ Form::label('tag_name','タグ名')}}<br>
                            {{ Form::text('tag_name', $tag->tag_name, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '地域名'])}}
                        </div>
                        <hr>
                        <div class="py-6">
                            {{ Form::label('tag_name_kana','カタカナ（タグ名）')}}<br>
                            {{ Form::text('tag_name_kana',  $tag->tag_name_kana, ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'カナ名'])}}
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.tags.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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
