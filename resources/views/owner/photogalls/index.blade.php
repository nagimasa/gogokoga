<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            写真ギャラリー
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}の画像一覧（計：{{ $count }}件）</h2>
                    <div class="p-6">
                        <div class="md:flex flex-wrap">
                            @foreach($photogalls as $photo)
                            <div class="md:w-1/6 f-full p-2">
                                <img class="mb-2" src="{{ asset($photo->image_name) }}">
                                <a href="{{ route('owner.photogalls.edit', ["photogalls" => $service->id, "photo" => $photo->id]) }}">削除</a>
                            </div>
                            <hr>
                            @endforeach
                        </div>

                        <div class="pt-6">
                            <div class="flex justify-between">
                                <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                <div class="bg-gray-200 h-10">
                                    {{-- {{ $photogalls->links() }} --}}
                                </div>
                                <a href="{{ route('owner.photogalls.create', $id) }}">
                                    <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>