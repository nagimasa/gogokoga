<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $owner->service->service_name }}の管理画面
        </h2>
    </x-slot>

    <div class="md:flex wrap">

        <div class="py-6 px-2 md:w-1/3">
            <div class="max-w-7xl mx-auto sm:px-2">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-t-8 border-blue-700">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-2xl pb-6">基本設定</h3>
                        {{-- <a href="{{ route('') }}"></a> --}}
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">基本情報</h4>
                            <ul>
                                <li class="pl-4"><a href="{{ route('owner.services.show', [$owner->service->id]) }}">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">ひと言</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">画像ギャラリー</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t">
                            <h4 class="font-bold text-xl py-2">メニュー</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="py-6 px-2 md:w-1/3">
            <div class="max-w-7xl mx-auto sm:px-2">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-t-8 border-green-700">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-2xl pb-6">特別設定</h3>
                        {{-- <a href="{{ route('') }}"></a> --}}
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">ストリートビュー</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">SNS</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">タグ</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="py-6 px-2 md:w-1/3">
            <div class="max-w-7xl mx-auto sm:px-2">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-t-8 border-yellow-500">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-2xl pb-6">更新情報</h3>
                        {{-- <a href="{{ route('') }}"></a> --}}
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">求人情報</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">クーポン</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">ブログ</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">登録・編集</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="py-6 px-2 md:w-1/3">
            <div class="max-w-7xl mx-auto sm:px-2">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border-t-8 border-red-600">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold text-2xl pb-6">アカウント情報</h3>
                        {{-- <a href="{{ route('') }}"></a> --}}
                        <div class="border-t pb-4">
                            <h4 class="font-bold text-xl py-2">担当者情報</h4>
                            <ul>
                                <li class="pl-4"><a href="">確認</a></li>
                                <li class="pl-4"><a href="">お問い合わせ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
