<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            地域名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between">
                        <h3 class="text-xl">地域名の一覧（計：{{ $count }}件）</h3>
                        <a href="{{ route('admin.areas.create') }}">
                            <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                        </a>
                    </div>
                    <hr>
                    <table class="w-full">
                        <tr>
                          <th class="w-8 py-4">ID</th>
                          <th class="">地域名</th>
                          <th class="">チイキメイ</th>
                        </tr>

                        @foreach($areas as $area)
                        <tr class="divide-y">
                          <td class="w-8 py-4 text-center">{{ $area->id }}</td>
                          <td class=""><a class="text-indigo-600 underline" href="{{ route('admin.areas.show', ['area'=>$area->id])}}">{{ $area->area_name }}</a></td>
                          <td class="">{{ $area->area_name_kana }}</td>
                        </tr>
                        @endforeach
                    </table>


                </div>
                <div class="bg-gray-200 h-10">
                    {{ $areas->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
