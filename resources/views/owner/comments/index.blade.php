<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            支払い方法
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between">
                        <h3 class="text-xl">支払い方法の一覧（計：{{ $count }}件）</h3>
                        <a href="{{ route('owner.payments.create') }}">
                            <button class="text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded">新規登録</button>
                        </a>
                    </div>
                    <hr>
                    <table class="w-full">
                        <tr>
                          <th class="w-8 py-4">ID</th>
                          <th class="">支払い方法</th>
                        </tr>

                        @foreach($payments as $payment)
                        <tr class="divide-y">
                          <td class="w-8 py-4 text-center">{{ $payment->id }}</td>
                          <td class=" text-center"><a class="text-indigo-600 underline" href="{{ route('owner.payments.show', ['payment'=>$payment->id])}}">{{ $payment->payment_name }}</a></td>
                        </tr>
                        @endforeach
                    </table>


                </div>
                <div class="bg-gray-200 h-10">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
