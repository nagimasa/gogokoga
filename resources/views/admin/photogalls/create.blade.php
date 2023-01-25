<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の画像登録
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">画像の登録</h2>

                    <div class="p-6">
                        
                        <div class="container">
                            <div class="card mt-3">
                                {{ Form::open(['route' => ['admin.photogalls.store',  [$service->id]], 
                                'method'  => 'post', 'file' => true,
                                'enctype' => 'multipart/form-data',
                                'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                                    @csrf
                                    @method('post')
                                        
                                    {{-- Form --}}
                                    {{Form::hidden('service_id', $service->id )}}

                                    {{ Form::file('image_name[]', ['multiple'] ) }}

                                    <a href="{{ route('admin.photogalls.index', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                        戻る
                                    </a>
                                    {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
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

