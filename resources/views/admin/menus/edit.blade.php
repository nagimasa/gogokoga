<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}のメニュー登録
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">メニュー登録</h2>
                    </div>


                    
                    <form action="{{ route('admin.menus.update', [$service->id]) }}" method="POST">
                        @csrf
                        @method('POST')
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
                                <th></th>
                                <th>メニュー名</th>
                                <th>料金</th>
                                <th>アクション</th>
                                <th></th>
                            </tr>
                            @foreach($menus as $menu)
                            <tr>
                                <td><input type="text" name="moreFields[0][id]" value="{{ $menu->id }}" class="form-control" /></td>
                                <td><input type="hidden" name="moreFields[0][service_id]" value="{{ $service->id }}" /></td>  
                                <td><input type="text" name="moreFields[0][menu_name]" value="{{ $menu->menu_name }}" class="form-control" /></td>  
                                <td><input type="text" name="moreFields[0][menu_fee]"  value="{{ $menu->menu_fee }}" class="form-control" /></td>  
                                {{-- <td><input type="checkbox" name="moreFields[0][delete]" value="{{ $menu->id }}" class="form-control" />削除</td> --}}
                            </tr>
                            @endforeach
                            <tr> 
                                <td><input type="text" name="moreFields[0][id]" value="" class="form-control" /></td>
                                <td><input type="hidden" name="moreFields[0][service_id]" value="{{ $service->id }}" /></td>  
                                <td><input type="text" name="moreFields[0][menu_name]" value="" placeholder="メニュー名" class="form-control" /></td>  
                                <td><input type="text" name="moreFields[0][menu_fee]" value="" placeholder="料金" class="form-control" /></td>  
                                <td><button type="button" name="add" id="add-btn" class="btn btn-success">フォームを追加する</button></td>  
                            </tr>  
                        </table> 
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>



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
            '<tr><td><input type="text" name="moreFields['+i+'][id]" value="" /></td><td><input type="hidden" name="moreFields['+i+'][service_id]" value="{{ $service->id }}" /></td><td><input type="text" name="moreFields['+i+'][menu_name]" placeholder="サービス名" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][menu_fee]" placeholder="料金" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">フォームを削除</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
    });  
</script>
</x-app-layout>