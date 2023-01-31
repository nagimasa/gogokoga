<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のブログ詳細
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">ブログ：{{ $blogs->blog_title }}</h2>
                </div>
                <div class="p-6">

                    <div class="py-6">
                        <p>ブログタイトル</p>
                        <h3>{{ $blogs->blog_title }}</h3>
                    </div>
                    <hr>
                    <div class="py-6">
                        <div>{!! $blogs->blog_text !!}</div>
                    </div>
                    <hr>
                    @if(!empty($blogs->blog_image_name))
                    <div class="py-6">
                        <img src="{{ asset($blogs->blog_image_name) }}">
                    </div>
                        <hr>
                    @endif

                    <div class="pt-6">
                        <div class="py-2 flex justify-between">
                            <a href="{{ route('admin.blogs.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            <a class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded" href="{{ route('admin.blogs.edit',$blogs->id)}}">
                                編集
                            </a>
                        </div>
                     </div>
                </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
