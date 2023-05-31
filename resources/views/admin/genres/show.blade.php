<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            ジャンル名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">ジャンル名：{{ $genre->genre_name }}</h2>

                    <div class="p-6">
                        <div class="py-6">
                            <p>ジャンル名</p>
                            <p>{{ $genre->genre_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p>カタカナ</p>
                            <p>{{ $genre->genre_name_kana }}</p>
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.genres.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.genres.edit', ['genre'=>$genre->id])}}">
                                編集
                            </a>
                        </div>
                     </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
