<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            メニュー名：{{ $menu->menu_name }}の編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $menu->menu_name }}の編集</h2>
                        <div class=" p-6">
                            {{ Form::open(['route' => ['owner.menus.destroy', ["menu" => $service->id ,"detail" => $menu->id]], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>

                    <div class="p-6">
                        {{ Form::open(['route' => ['owner.menus.update', ["menu" => $service->id ,"detail" => $menu->id]], 'method' => 'post']) }}
                    @csrf
                    @method('POST')
                    <div class="py-6">
                        {{ Form::label('menu_name','メニュー名')}}<br>
                        {{ Form::text('menu_name', $menu->menu_name, ['class' => 'w-full md:w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => $menu->menu_name])}}
                    </div>
                    <hr>
                    <div class="py-6">
                        {{ Form::label('menu_fee','料金')}}<br>
                        {{ Form::text('menu_fee', $menu->menu_fee, ['class' => 'w-full md:w-1/2 rounded form-control ', 'id' => 'lastName'])}}円
                    </div>
                    <hr>
                    <div class="pt-6 flex justify-between">
                        <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                            戻る
                        </a>
                        {{ Form::submit('保存', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                        {{ Form::close() }}
                    </div>
                 </div>





                     </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
