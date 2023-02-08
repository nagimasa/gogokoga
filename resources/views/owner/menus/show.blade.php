<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のメニュー一覧
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">メニュー：計{{ $count }}件</h2>
                    <div class="p-6">
                        <table class="table table-bordered w-full" id="dynamicAddRemove">  
                            <tr class="border-b">
                                <th class="w-2/5 text-left py-2">メニュー名</th>
                                <th class="w-2/5 text-left py-2">料金</th>
                                <th class="w-8 text-left py-2">編集</th>
                            </tr>
                            @foreach($menus as $menu)
                            <tr class="border-b">  
                                <td class="w-2/5 py-2">{{ $menu->menu_name }}</td>  
                                <td class="w-2/5 py-2">{{ $menu->menu_fee }}円</td>
                                <td class="w-8 py-2"><a class="text-indigo-600 underline" href="{{ route('owner.menus.edit', ["menu" => $service->id ,"detail" => $menu->id]) }}">編集</a></td>
                                {{-- <td class="w-8 py-2"><a class="text-indigo-600 underline" href="{{ route('owner.menus.edit', ["menu" =>$service->id ,"detail" => $menu->id]) }}">編集</a></td> --}}
                            </tr>  
                            @endforeach
                        </table> 



                        <div class="pt-6">
                            <div class="flex justify-between">
                                <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('owner.menus.create', [$service->id])}}">
                                    追加
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
