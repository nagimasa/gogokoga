<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            ブログ
        </h1>
    </x-slot>

    <div class="py-12 p-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}の一覧（計：{{ $count }}件）</h2>
                    <div class="p-6">
                        <table class="w-full">
                            <tr class="border-b">
                                <th class="w-8 py-2">ID</th>
                                <th class="w-2/5 py-2">ブログタイトル</th>
                                <th class="w-2/5 py-2"></th>
                            </tr>

                            @foreach($blogs as $blog)
                            <tr class="border-b">
                                <td class="w-8 py-4 text-center">{{ $blog->id }}</td>
                                <td class="w-2/5 py-2"><a class="text-indigo-600 underline" href="{{ route('owner.blogs.show', ["blogs" => $service->id, "detail" => $blog->id] )}}">{{ $blog->blog_title }}</a></td>
                                <td class="w-2/5 py-2 text-center"><a class="text-indigo-600 underline" href="{{ route('owner.blogs.edit', ["blogs" => $service->id, "detail" => $blog->id] )}}">編集</a></td>
                            </tr>
                            @endforeach
                        </table>

                        <div class="pt-6">
                            <div class="flex justify-between">
                                <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                <div class="bg-gray-200 h-10">
                                    {{ $blogs->links() }}
                                </div>
                                <a href="{{ route('owner.blogs.create') }}">
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
