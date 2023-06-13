<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            地域名
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">地域名：{{ $area->area_name }}</h2>

                    <div class="p-6">
                        <div class="py-6">
                            <p>地域名</p>
                            <p>{{ $area->area_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p>地域名（カナ）</p>
                            <p>{{ $area->area_name_kana }}</p>
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.areas.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.areas.edit', ['area'=>$area->id])}}">
                                編集
                            </a>
                        </div>
                     </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
