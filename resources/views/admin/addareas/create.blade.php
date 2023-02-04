<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            独自広告の登録
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">画像の登録</h2>
                </div>
                    <div class="p-6">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                                {{ Form::open(['route' => ['admin.addareas.store'], 
                                'method'  => 'post', 'file' => true,
                                'enctype' => 'multipart/form-data',
                                'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                                @csrf
                                @method('post')
                                        
                                    {{-- Form --}}
                                    {{-- {{Form::hidden('service_id', $service->id )}} --}}
        
                                <div class="py-6">
                                    {{ Form::label('service_id','出稿事業者', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::select('service_id', $services) }}
                                </div>
                                <hr>
        
                                <div class="py-6">
                                    {{ Form::label('add_area','表示枠の選択', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::select('add_area', $area_number) }}
                                </div>
                                <hr>
        
                                <div class="py-6">
                                    {{ Form::label('add_area_image','画像アップロード', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::file('add_area_image' ) }}
                                </div>

                                    <div class="pt-6">
                                        <div class="py-2 flex justify-between">
                                            <a href="{{ route('admin.addareas.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                                戻る
                                            </a>
                                            {{ Form::submit('保存', ['class' => 'btn btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>

