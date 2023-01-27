<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            サービス名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between">
                        <h3 class="text-xl">サービス名の一覧（計：{{ $count }}件）</h3>
                        <a href="{{ route('admin.services.create') }}">
                            <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                        </a>
                    </div>
                    <hr>
                    <table class="w-full">
                        <tr>
                            <th class="w-8 py-4">ID</th>
                            <th class="">サービス名</th>
                            <th class="">ジャンル</th>
                            <th class="">会員種別</th>
                            <th class="">ひと言</th>
                            <th class="">クーポン</th>
                            <th class="">管理者</th>
                            <th class="">求人</th>
                            <th class="">メニュー</th>
                            <th class="">ブログ</th>
                            <th class="">画像</th>
                        </tr>

                        @foreach($services as $service)
                        {{-- <?php dd($service) ?> --}}
                        <tr class="divide-y">
                            <td class="w-8 py-4 text-center">{{ $service->id }}</td>
                            <td class=" text-center"><a class="text-indigo-600 underline" href="{{ route('admin.services.show', ['service'=>$service->id])}}">{{ $service->service_name }}</a></td>
                            <td class="text-center">{{ $service->genre->genre_name }}</td>
                            <td class="text-center">{{ $service->genre->genre_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.comments.show', [$service->id]) }}", class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.coupons.show', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>


                            <td class="text-center"><a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">編集</a></td>
                            
                            
                            <td class="text-center">
                                <a href="{{ route('admin.reqruits.show', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.menus.show', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.blogs.index', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.photogalls.index', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
                <div class="bg-gray-200 h-10">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
