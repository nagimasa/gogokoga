
@include('layouts.user')

<main class="detail sm:max-w-3xl sm:m-auto">

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300 m-auto">
            {{ Form::open(['route' => ['user.contact.send'], 'method' => 'post']) }}
            @csrf
            @method('post')
                {{-- Form --}}
                <div class="block py-6 border-b">
                    {{ Form::label('service_name','事業者名', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['service_name'] }}</p>
                    {{ Form::hidden('service_name', $inputs['service_name'] )}}
                </div>
                
                <div class="block py-6 border-b">
                    {{ Form::label('name','お名前', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['name'] }}</p>
                    {{ Form::hidden('name', $inputs['name'] )}}
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('kana_name','お名前（カタカナ）', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['kana_name'] }}</p>
                    {{ Form::hidden('kana_name', $inputs['kana_name'] )}}
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('tel','電話番号', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['tel'] }}</p>
                    {{ Form::hidden('tel', $inputs['tel'] )}}
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('email','メールアドレス', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['email'] }}</p>
                    {{ Form::hidden('email', $inputs['email'] )}}
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('email_confirm','メールアドレス（確認用）', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['email_confirm'] }}</p>
                    {{ Form::hidden('email_confirm', $inputs['email_confirm'] )}}
                </div>

                <div class="block py-6 border-b">
                    {{ Form::label('content','問い合わせ内容', ['class' => 'form-check-label block font-bold']) }}
                    <p>{{ $inputs['content'] }}</p>
                    {{ Form::hidden('content', $inputs['content'] )}}
                </div>

                {{ Form::submit('送信', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </section>
    </article>

</main>

@include('layouts.user-footer')