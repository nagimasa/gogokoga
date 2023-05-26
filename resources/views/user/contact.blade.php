
@include('layouts.user')

<main class="detail sm:max-w-3xl sm:m-auto">

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300 m-auto">
            {{ Form::open(['route' => ['user.contact.confirm'], 'method' => 'post']) }}
            @csrf
            @method('post')
                {{-- Form --}}
                <div class="block py-6 border-b">
                    {{ Form::label('service_name','事業者名', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('service_name',old('service_name'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => '事業者名']) }}<br>
                </div>
                
                <div class="block py-6 border-b">
                    {{ Form::label('name','お名前', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('name',old('name'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => 'お名前']) }}<br>
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('kana_name','お名前（カタカナ）', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('kana_name',old('kana_name'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => 'オナマエ（カナ）']) }}<br>
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('tel','電話番号', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('tel',old('tel'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => '0000000000']) }}<br>
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('email','メールアドレス', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('email',old('email'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => 'example@mail.com']) }}<br>
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('email_confirm','メールアドレス（確認用）', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::text('email_confirm',old('email_confirm'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => 'example@mail.com']) }}<br>
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('content','問い合わせ内容', ['class' => 'form-check-label block font-bold']) }}
                    {{ Form::textarea('content', old('content'), ['required' => 'required', 'class' => 'rounded w-full md:w-1/2 ', 'placeholder' => '問い合わせ内容を記入してください']) }}<br>
                </div>

                {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </section>
    </article>

</main>

@include('layouts.user-footer')