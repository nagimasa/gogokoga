<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            独自広告管理
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">広告の状況</h2>
                    <div class="p-6">

                        <div class="py-6">
                            <p class="font-bold">TOPページ上部</p>
                                @foreach($add_top as $add)
                                <div class="md:w-1/5 w-full p-2">
                                    {{-- @if($add->add_area_image == true) --}}
                                    <img class="mb-2" src="{{ asset($add->add_area_image) }}">
                                    <a href="{{ route('admin.addareas.edit', [$add->id]) }}">削除</a>
                                    {{-- @else
                                    <p>てすと</p>
                                    <img class="mb-2" src="{{ asset('dammy.png') }}">
                                    @endif --}}
                                </div>
                            @endforeach
                            </div>
                            <hr>

                            <div class="py-6">
                                <p class="font-bold">カテゴリ枠</p>
                                @foreach($add_category as $add)
                                    <div class="md:w-1/5 w-full p-2">
                                        {{-- @if($add->add_area_image == true) --}}
                                        <img class="mb-2" src="{{ asset($add->add_area_image) }}">
                                        <a href="{{ route('admin.addareas.edit', [$add->id]) }}">削除</a>
                                        {{-- @else
                                        <p>てすと</p>
                                        <img class="mb-2" src="{{ asset('dammy.png') }}">
                                        @endif --}}
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">代行・タクシー枠</p>
                                @foreach($add_cars as $add)
                                    <div class="md:w-1/5 w-full p-2">
                                        <img class="mb-2" src="{{ asset($add->add_area_image) }}">
                                        <a href="{{ route('admin.addareas.edit', [$add->id]) }}">削除</a>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">TOPページ下部枠</p>
                                @foreach($add_bottom as $add)
                                    <div class="md:w-1/5 w-full p-2">
                                        <img class="mb-2" src="{{ asset($add->add_area_image) }}">
                                        <a href="{{ route('admin.addareas.edit', [$add->id]) }}">削除</a>
                                    </div>
                                @endforeach
                            </div>
                            <hr>

                        <div class="pt-6">
                            <div class="flex justify-between">
                                <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                <div class="bg-gray-200 h-10">
                                    {{-- {{ $photogalls->links() }} --}}
                                </div>
                                <a href="{{ route('admin.addareas.create') }}">
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
