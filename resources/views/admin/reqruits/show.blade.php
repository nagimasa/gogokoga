<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の求人情報
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}の求人情報</h2>

                    @if(!empty($reqruit))
                    <div class="p-6">
                        <div class="py-6">
                            <p class="font-bold">公開状態</p>
                            @if($reqruit->visualize == 1)
                            <p>公開</p>
                            @else
                            <p>非公開</p>
                            @endif
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">ジャンル</p>
                            <p>{{ $service->genre->genre_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">求人見出し</p>
                            <p>{{ $reqruit->reqruit_title }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">求人本文</p>
                            <p>{!! $reqruit->reqruit_text !!}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">雇用形態</p>
                            <p>{{ $reqruit->work_type }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">1日の勤務時間</p>
                            <p>{{ $reqruit->work_in_day }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">１週間の勤務日数</p>
                            <p>{{ $reqruit->work_in_week }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">給料</p>
                            <p>{{ $reqruit->fee_type }}{{ $reqruit->fee }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">勤務地</p>
                            <p>{{ $reqruit->address }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">備考</p>
                            <p>{{ $reqruit->another }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">担当者名</p>
                            <p>{{ $reqruit->maneger_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">担当者名カタカナ</p>
                            <p>{{ $reqruit->maneger_name_kana }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">担当者電話番号</p>
                            <p>{{ $reqruit->maneger_tel }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">担当者メールアドレス</p>
                            <p>{{ $reqruit->maneger_email }}</p>
                        </div>
                        <hr>
                        @else
                        <div class="py-6">
                            <p>登録されていません。</p>
                        </div>
                        <hr>
                        @endif


                    </div>
                    <div class="p-6">
                        
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            @if(!empty($reqruit))
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.reqruits.edit',$service->id)}}">
                                編集
                            </a>
                            @else
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.reqruits.create',$service->id)}}">
                                作成
                            </a>
                            @endif
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