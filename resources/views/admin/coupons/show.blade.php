<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のクーポン情報
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">{{ $service->service_name }}のクーポン情報</h2>
                    <div class="p-6">
                        <div class="py-6">
                            @if(empty($coupon))
                            <p class="font-bold">掲載状況</p>
                            <p>クーポン情報は登録されていません。</p>
                        </div>
                            @else
                        <div class="py-6">
                            <p class="font-bold">ジャンル</p>
                            <p>{{ $service->genre->genre_name }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">クーポン見出し</p>
                            <p>{{ $coupon->coupon_title }}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">クーポン詳細</p>
                            <p>{!! $coupon->coupon_text !!}</p>
                        </div>
                        <hr>
                        <div class="py-6">
                            <p class="font-bold">掲載画像</p>
                            @if($coupon->coupon_image == true)
                            <img src="{{ asset($coupon->coupon_image) }}">
                            @else
                            画像は登録されていません。
                            @endif
                        </div>
                        @endif

                    <div class="pt-6 border-t">
                        <div class="flex justify-between">
                            <a href="{{ route('admin.services.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            @if(!empty($coupon))
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.coupons.edit',$service->id)}}">
                                編集
                            </a>
                            @else
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.coupons.create',$service->id)}}">
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
    </div>
</x-app-layout>
