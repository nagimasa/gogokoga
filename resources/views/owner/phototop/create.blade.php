<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の画像登録
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">画像の登録</h2>
                </div>
                    <div class="p-6">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                                {{ Form::open(['route' => ['owner.phototop.store',  [$service->id]], 
                                'method'  => 'post', 'file' => true,
                                'enctype' => 'multipart/form-data',
                                'accept'  => 'image/png, image/jpeg, image/jpg, image/webp' ]) }}
                                @csrf
                                @method('post')
                                        
                                    {{-- Form --}}
                                    {{Form::hidden('service_id', $service->id )}}

                                <div class="block py-6 border-b">
                                    {{ Form::label('top_image_name','画像アップロード', ['class' => 'form-check-label block font-bold']) }}
                                    {{ Form::file('top_image_name') }}
                                </div>

                                    <div class="pt-6">
                                        <div class="py-2 flex justify-between">
                                            <a href="{{ route('owner.phototop.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
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




<script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function(){
        ++i;
        $("#dynamicAddRemove").append(
            '<tr><td><input type="hidden" name="moreFields['+i+'][service_id]" value="{{ $service->id }}" /></td><td><input type="text" name="moreFields['+i+'][menu_name]" placeholder="サービス名" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][menu_fee]" placeholder="料金" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">フォームを削除</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
    });  
</script>


</x-app-layout>

