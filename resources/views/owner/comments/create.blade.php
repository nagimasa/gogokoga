<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            支払い方法
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <h2 class="text-xl bg-blue-600 text-white p-6">支払い方法名の登録</h2>

                    <div class="p-6">
                            {{ Form::open(['route' => ['owner.payments.store'], 'method' => 'post']) }}
                        @csrf
                        @method('post')
                        <div class="py-6">
                            {{ Form::label('payment_name','支払い方法名')}}<br>
                            {{ Form::text('payment_name', old('payment_name'), ['class' => 'w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => '支払い方法名'])}}
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('owner.payments.index') }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                     </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
