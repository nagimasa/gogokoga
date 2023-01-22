<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            ブログ
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between">
                        <h3 class="text-xl">{{ $service->service_name }}の一覧（計：{{ $count }}件）</h3>
                        <a href="{{ route('admin.blogs.create', $service->id) }}">
                            <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                        </a>
                    </div>
                    <hr>
                    <table class="w-full">
                        <tr>
                          <th class="w-8 py-4">ID</th>
                          <th class="">ブログタイトル</th>
                          <th class="">アクション</th>
                        </tr>

                        @foreach($blogs as $blog)
                        <tr class="divide-y">
                          <td class="w-8 py-4 text-center">{{ $blog->id }}</td>
                          <td class=" text-center"><a class="text-indigo-600 underline" href="{{ route('admin.blogs.show', $blog->id)}}">{{ $blog->blog_title }}</a></td>
                          <td class=" text-center"><a class="text-indigo-600 underline" href="{{ route('admin.blogs.edit', $blog->id)}}">編集</a></td>
                        </tr>
                        @endforeach
                    </table>


                </div>

                <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                    戻る
                </a>
                <div class="bg-gray-200 h-10">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
