<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の{{ $reqruit->reqruit_title }}の編集
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $reqruit->reqruit_title }}の編集</h2>
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['owner.reqruits.destroy', $service->id], 
                            'method'  => 'post', 'file' => true,
                            'enctype' => 'multipart/form-data',
                            'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                            @csrf
                            @method('delete')
                            {{ Form::hidden('delete_image_name', $reqruit->hero_image) }}
                            {{ Form::submit('削除', ['class' => 'text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class=" p-6">

                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        
                            {{ Form::open(['route' => ['owner.reqruits.update', $service->id],
                            'method'  => 'post',
                            'file'    => true,
                            'enctype' => 'multipart/form-data',
                            'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                            @csrf
                            @method('PATCH')
                                
                            {{-- Form --}}
                            {{Form::hidden('service_id', $service->id )}}
                            {{Form::hidden('id', $reqruit->id )}}

                        <div class="block py-6 border-b">
                            {{ Form::label('reqruit_title','求人の見出し', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('reqruit_title',$reqruit->reqruit_title, ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('reqruit_text','求人の本文', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::textarea('reqruit_text',$reqruit->reqruit_text, ['id' => 'ckeditor', 'placeholder' => 'ここに求人の詳細情報を記入してください。', 'class' => 'rounded w-full md:w-1/2 ']) }}
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('work_type','雇用形態', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::select('work_type',
                                ['parttime' => 'パート', 'arbeit' => 'アルバイト', 'contract_employee' => '契約社員', 'employee' => '正社員'],$reqruit->work_type,
                                ['class' => 'rounded w-full md:w-1/2 block'])
                            }}
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('work_in_day','1日の勤務時間', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('work_in_day',$reqruit->work_in_day, ['required' => 'required', 'placeholder' => '例）9時〜17時のうちの6時間', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('work_in_week','１週間の勤務日数', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('work_in_week',$reqruit->work_in_week, ['required' => 'required', 'placeholder' => '例）週2日からOK', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('fee_type','お給料設定', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::select('fee_type',
                                ['時給' => '時給', '日給' => '日給', '月給' => '月給'],$reqruit->fee_type,
                                ['class' => 'rounded w-full md:w-1/2 block'])
                            }}
                            </div>

                            <div class="block py-6 border-b">
                            {{ Form::label('fee','金額', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('fee',$reqruit->fee, ['required' => 'required', 'placeholder' => '例）時給選択時900円、月給選択時14万円など', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
    
                            {{ Form::label('address','勤務地', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('address',$reqruit->address, ['required' => 'required', 'placeholder' => '例）古賀市○○○1-2-3', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('maneger_name','担当者名', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('maneger_name',$reqruit->maneger_name, ['required' => 'required', 'placeholder' => '例）山田太郎', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('maneger_name_kana','担当者名カタカナ', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('maneger_name_kana',$reqruit->maneger_name_kana, ['required' => 'required', 'placeholder' => '例）ヤマダタロウ', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('maneger_tel','担当者電話番号', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('maneger_tel',$reqruit->maneger_tel, ['required' => 'required', 'placeholder' => '例）092-123-4567', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('maneger_email','担当者メールアドレス', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::text('maneger_email',$reqruit->maneger_email, ['required' => 'required', 'placeholder' => '例）reqruit@example.com', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            {{ Form::label('another','備考欄', ['class' => 'form-check-label block font-bold']) }}
                            {{ Form::textarea('another',$reqruit->another, ['required' => 'required', 'placeholder' => '備考欄', 'class' => 'rounded w-full md:w-1/2 ']) }}<br>
                        </div>

                        <div class="block py-6 border-b">
                            <p class=" block font-bold">掲載設定</p>
                            {{ Form::radio('visualize', 1, true) }}
                            {{ Form::label('visualize', '公開', ['class' => 'pr-6']) }}
                            {{ Form::radio('visualize', 0) }}
                            {{ Form::label('visualize', '非公開') }}
                        </div>
    

                        <div class="block py-6 border-b">
                            <p class="font-bold">画像アップロード</p>
                            @if($reqruit->hero_image)
                            <img src="{{ asset($reqruit->hero_image) }}" alt="">
                            @else
                            <p>画像は設定されていません。</p>
                            @endif
                            {{ Form::file('hero_image', ) }}
                        </div>
    

                        <div class="pt-6">
                            <div class="py-2 flex justify-between">
                            <a href="{{ route('owner.reqruits.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn-primary text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>

</x-app-layout>
