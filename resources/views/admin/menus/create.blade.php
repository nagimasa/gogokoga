<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            メニュー名
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">メニュー名の登録</h2>

                    <div class="p-6">
                        
                        <div class="container">
                            <div class="card mt-3">
                                <form action="{{ route('admin.menus.store', [$service->id])}}" method="POST">
                                    @csrf
                                    @method('post')
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                    @endif
                                    <table class="table table-bordered" id="dynamicAddRemove">  
                                        <tr>
                                            <th></th>
                                            <th class="w-1/2">メニュー名</th>
                                            <th class="w-1/2">料金（半角数字）</th>
                                            <th class=""></th>
                                        </tr>
                                        <tr>  
                                            <td><input type="hidden" name="moreFields[0][service_id]" value="{{ $service->id }}" /></td>  
                                            <td><input type="text" name="moreFields[0][menu_name]" placeholder="サービス名" class="form-control w-full" /></td>  
                                            <td><input type="text" name="moreFields[0][menu_fee]" placeholder="料金（半角数字）" class="form-control w-full" /></td>
                                            <td>円</td>
                                        </tr>
                                        <button type="button" name="add" id="add-btn" class="btn btn-success">フォームを追加する</button>
                                    </table>

                                    <div class="pt-6">
                                        <div class="py-2 flex justify-between">
                                            <a href="{{ route('admin.menus.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                                戻る
                                            </a>
                                            <button type="submit" class="btn btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">保存</button>
                                        </div>
                                    </div>
                                </form>
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
            '<tr><td><input type="hidden" name="moreFields['+i+'][service_id]" value="{{ $service->id }}" /></td><td><input type="text" name="moreFields['+i+'][menu_name]" placeholder="サービス名" class="form-control w-full" /></td><td><input type="text" name="moreFields['+i+'][menu_fee]" placeholder="料金（半角数字）" class="form-control w-full"/></td><td>円</td><td><button type="button" class="btn btn-danger remove-tr">削除</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
    });  
</script>


</x-app-layout>

