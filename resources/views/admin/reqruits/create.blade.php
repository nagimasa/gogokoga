<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $service->service_name }}の求人登録
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $service->service_name }}の求人登録</h2>
                    </div>
                    <div class=" pr-6 pt-6">
                        {{ Form::open(['route' => ['admin.reqruits.store', $service->id],
                        'method'  => 'post',
                        'file'    => true,
                        'enctype' => 'multipart/form-data',
                        'accept'  => 'iamge/png, image/jpeg, image/jpg, image/webp' ]) }}
                        @csrf
                        @method('post')
                            
                        {{-- Form --}}
                        {{Form::hidden('service_id', $service->id )}}

                        {{ Form::label('reqruit_title','求人の見出し', ['class' => 'form-check-label']) }}
                        {{ Form::text('reqruit_title',old('reqruit_title'), ['required' => 'required']) }}<br>

                        {{ Form::label('reqruit_text','求人の本文', ['class' => 'form-check-label']) }}
                        {{ Form::textarea('reqruit_text',old('reqruit_text'), ['id' => 'ckeditor', 'placeholder' => 'ここに求人の詳細情報を記入してください。']) }}

                        {{ Form::label('work_type','雇用形態', ['class' => 'form-check-label']) }}
                        {{ Form::select('work_type',
                            ['parttime' => 'パート', 'arbeit' => 'アルバイト', 'contract_employee' => '契約社員', 'employee' => '正社員'],
                            ['id' => ''])
                        }}

                        {{ Form::label('work_in_day','1日の勤務時間', ['class' => 'form-check-label']) }}
                        {{ Form::text('work_in_day',old('work_in_day'), ['required' => 'required', 'placeholder' => '例）9時〜17時のうちの6時間']) }}<br>

                        {{ Form::label('work_in_week','１週間の勤務日数', ['class' => 'form-check-label']) }}
                        {{ Form::text('work_in_week',old('work_in_week'), ['required' => 'required', 'placeholder' => '例）週2日からOK']) }}<br>

                        {{ Form::label('fee_type','お給料設定', ['class' => 'form-check-label']) }}
                        {{ Form::select('fee_type',
                            ['時給' => '時給', '日給' => '日給', '月給' => '月給'],
                            ['id' => ''])
                        }}

                        {{ Form::label('fee','金額', ['class' => 'form-check-label']) }}
                        {{ Form::text('fee',old('fee'), ['required' => 'required', 'placeholder' => '例）時給選択時900円、月給選択時14万円など']) }}<br>


                        {{ Form::label('address','勤務地', ['class' => 'form-check-label']) }}
                        {{ Form::text('address',old('address'), ['required' => 'required', 'placeholder' => '例）古賀市○○○1-2-3']) }}<br>

                        {{ Form::label('maneger_name','担当者名', ['class' => 'form-check-label']) }}
                        {{ Form::text('maneger_name',old('maneger_name'), ['required' => 'required', 'placeholder' => '例）山田太郎']) }}<br>

                        {{ Form::label('maneger_name_kana','担当者名カタカナ', ['class' => 'form-check-label']) }}
                        {{ Form::text('maneger_name_kana',old('maneger_name_kana'), ['required' => 'required', 'placeholder' => '例）ヤマダタロウ']) }}<br>

                        {{ Form::label('maneger_tel','担当者電話番号', ['class' => 'form-check-label']) }}
                        {{ Form::text('maneger_tel',old('maneger_tel'), ['required' => 'required', 'placeholder' => '例）092-123-4567']) }}<br>

                        {{ Form::label('maneger_email','担当者メールアドレス', ['class' => 'form-check-label']) }}
                        {{ Form::text('maneger_email',old('maneger_email'), ['required' => 'required', 'placeholder' => '例）reqruit@example.com']) }}<br>

                        {{ Form::label('another','備考欄', ['class' => 'form-check-label']) }}
                        {{ Form::textarea('another',old('another'), ['placeholder' => '備考欄']) }}<br>

                        {{ Form::radio('visualize', 1, true) }}
                        {{ Form::label('visualize', '公開') }}
                        {{ Form::radio('visualize', 0) }}
                        {{ Form::label('visualize', '非公開') }}



                        {{ Form::file('hero_image', ) }}

                        <a href="{{ route('admin.reqruits.show', $service->id) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                            戻る
                        </a>
                        {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
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

