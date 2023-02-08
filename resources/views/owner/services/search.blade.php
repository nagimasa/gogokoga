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
                        <h3 class="text-xl w-4/12">検索結果一覧（計：{{ $search_services->count() }}件）</h3>
                        <div class="flex wrap w-8/12 justify-end">
                            <div class="roudend pr-2">
                                {{ Form::open(['route' => ['admin.services.search'], 'method' => 'get']) }}
                                {{ Form::text('keyword', old('keyword'), ['placeholder' => 'キーワードを入力','class' => 'form-control roudend']) }}
                            </div>
                            <div class="roudend pr-2">
                                <select id="genre_id" name="genre_id">
                                    <option value="">ジャンルを選択</option>
                                    @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" roudend pr-2">
                                <select id="area_id" name="area_id">
                                    <option value="">地域を選択</option>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                            {{ Form::submit('検索', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="w-full">
                        <tr>
                            <th class="w-8 py-4">ID</th>
                            <th class="w-40">サービス名</th>
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

                        @foreach($search_services as $search_service)
                        <tr class="divide-y">
                            <td class="w-8 py-4 text-center">{{ $search_service->id }}</td>
                            <td class=" text-center"><a class="text-indigo-600 underline" href="{{ route('admin.services.show', ['service'=>$search_service->id])}}">{{ $search_service->service_name }}</a></td>
                            <td class="text-center">{{ $search_service->genre->genre_name }}</td>
                            <td class="text-center">{{ $search_service->genre->genre_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.comments.show', [$search_service->id]) }}", class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.coupons.show', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>


                            <td class="text-center">
                                <a href="{{ route('admin.owners.show', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            
                            
                            <td class="text-center">
                                <a href="{{ route('admin.reqruits.show', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.menus.show', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.blogs.index', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.photogalls.index', [$search_service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">確認</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <hr>
                    <div class="pt-6">
                        <div class="flex justify-between">
                            {{ $search_services->appends(request()->query())->links() }}
                            <a href="{{ route('admin.services.create') }}">
                                <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                            </a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>
