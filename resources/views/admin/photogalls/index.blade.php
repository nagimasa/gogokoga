<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            写真ギャラリー
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between">
                        <h3 class="text-xl">画像の一覧（計：{{ $count }}件）</h3>
                        <a href="{{ route('admin.photogalls.create', $id) }}">
                            <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                        </a>
                    </div>
                    <hr>
                    <table class="table table-bordered" id="dynamicAddRemove">  
                        <tr>
                            <th>画像</th>
                            <th>アクション</th>
                        </tr>
                        @foreach($photogalls as $photo)
                        <tr>
                            <td><img src="{{ asset($photo->image_name) }}"></td>
                            <td><a href="{{ route('admin.photogalls.edit', [$photo->id]) }}">削除</a></td>
                        </tr>  
                        @endforeach
                    </table> 



                </div>
                <div class="bg-gray-200 h-10">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
