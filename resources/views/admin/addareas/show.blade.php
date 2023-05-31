<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のメニュー一覧
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">メニュー：計{{ $count }}件</h2>

                    <table class="table table-bordered" id="dynamicAddRemove">  
                        <tr>
                            <th>メニュー名</th>
                            <th>料金</th>
                        </tr>
                        @foreach($menus as $menu)
                        <tr>  
                            <td>{{ $menu->menu_name }}</td>  
                            <td>{{ $menu->menu_fee }}</td>
                            <td><a href="{{ route('admin.menus.edit', [$menu->id]) }}">編集</a></td>
                        </tr>  
                        @endforeach
                    </table> 



                    <div class="p-6">
                        
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.menus.create', [$service->id])}}">
                                追加
                            </a>
                            {{-- <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.menus.edit', [$service->id])}}">
                                編集
                            </a> --}}
                        </div>
                     </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
