<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            タグ
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">タグの登録</h2>

                    <div class="p-6">

                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        
                            {{ Form::open(['route' => ['admin.tags.store'], 'method' => 'post']) }}
                        @csrf
                        @method('post')
                        <div class="py-6">
                            {{ Form::label('genre_id','ジャンル', ['class' => ' font-bold'])}}<br>
                            {{ Form::select('genre_id', $genres, ['class' => 'form-control']) }}
                        </div>
                        <hr>
                        <div class="py-6">
                            {{ Form::label('tag_name','タグ名')}}<br>
                            {{ Form::text('tag_name', old('tag_name'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'タグ名'])}}
                        </div>
                        <hr>
                        <div class="py-6">
                            {{ Form::label('tag_name_kana','カタカナ（タグ名）')}}<br>
                            {{ Form::text('tag_name_kana', old('tag_name_kana'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'カナ名'])}}
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.tags.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
