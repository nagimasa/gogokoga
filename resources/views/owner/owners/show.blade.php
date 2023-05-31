<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のオーナー情報
        </h1>
    </x-slot>

    <div class="py-12 p-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}のオーナー情報</h2>
                    <div class="p-6">
                        @if(!empty($owner))
                        <div class="py-6">
                            <p class="font-bold">登録状況</p>
                            <p>登録中</p>
                        </div>
                        <hr>

                            <div class="py-6">
                                <p class="font-bold">オーナー名</p>
                                <p>{{ $owner->name }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">カタカナ（オーナー名）</p>
                                <p>{{ $owner->name_kana }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">メールアドレス</p>
                                <p>{{ $owner->email }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">電話番号</p>
                                <p>{{ $owner->owner_tel }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">備考</p>
                                <p>{{ $owner->another }}</p>
                            </div>
                            <hr>
                            <div class="py-6">
                                <p class="font-bold">会員情報</p>
                                @if($owner->paid == null )
                                <p>無料会員</p>
                                @else
                                <p>有料会員</p>
                                @endif
                            </div>
                            <hr>
                        @else

                        <div class="py-6">
                            <p class="font-bold">登録状況</p>
                            <p>オーナー登録はされていません。</p>
                        </div>
                        <hr>
                        @endif

                        <div class="pt-6">
                            <div class="flex justify-between">
                                <a href="{{ route('owner.dashboard') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                    戻る
                                </a>
                                @if(!empty($owner))
                                <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('owner.owners.edit',$service->id)}}">
                                    編集
                                </a>
                                @else
                                {{-- <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('owner.owners.create',$service->id)}}">
                                    作成
                                </a> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
