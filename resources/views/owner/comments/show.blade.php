<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}支払い方法
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}のコメント</h2>
                    <div class="p-6">
                        <div class="py-6">
                            <p class="font-bold">コメント内容</p>
                            @if(!empty($comment->comment))
                            <p>{{ $comment->comment }}</p>
                            @else
                            <p>コメントは設定されていません</p>
                            @endif
                        </div>
                        <hr>
                        <div class="pt-6 flex justify-between">
                            <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('owner.comments.edit', [$service->id])}}">
                                編集
                            </a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
