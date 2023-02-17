<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>
        <div class="py-12 p-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="text-gray-900">
                        <h2 class="text-xl bg-blue-600 text-white p-6">ご登録フォーム</h2>
                            {{-- フォーム部分 --}}
                        <form action="{{route('owner.stripe.afterpay', $owner->id )}}" method="post" id="payment-form" class="p-6">
                            @csrf
                            <div class="py-6">
                                <label for="exampleInputEmail1">お名前</label>
                                <input type="test" class="form-control col-sm-5" id="card-holder-name" required>
                            </div>
                            <hr>
                            <div class="py-6">
                                <label for="exampleInputPassword1">カード番号</label>
                                <div class="form-group MyCardElement col-sm-5 py-6 border" id="card-element"></div>
                                <hr>
                                <div class="py-6" id="card-errors" role="alert" style='color:red; padding: 6,0;'></div>
                                <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">送信する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    月額会員登録
                    <p>月額1100円（税込）に登録していただくと、既存の機能の他に求人掲載、クーポンの掲載、ブログの作成が可能になります。
                    <div id="card-element"></div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
      <script src="https://js.stripe.com/v3/"></script>
      <script>
        const stripe = Stripe('pk_test_51J8IuFJmr5UR17GkfLjy0t2Vydx2Er4VmnBNtDs5vmHsumnihRKmQrIRpKBl2oei5BikxqoV420CKe5dOyEAmxoo00Cp8xEqqF');
        console.log(stripe)

        const stripe = Stripe('your_private_key');
        // const stripe = Stripe('sk_test_51J8IuFJmr5UR17GkYsokgmO8qoRRkaWiP5v1WWsUSq1ZP9UxmlMgAaXYjRxVMXbwC8T6s4RfJMNR93POnwjptXjm00EaGD3hBc');

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
      </script>
    @endpush --}}


      <script src="https://js.stripe.com/v3/"></script>
      <script>
 
        // HTMLの読み込み完了後に実行するようにする
        window.onload = my_init;
        function my_init() {
     
            // Configに設定したStripeのAPIキーを読み込む  
            const stripe = Stripe("{{ config('services.stripe.pb_key') }}");
            const elements = stripe.elements();
     
            var style = {
                base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
            };
            
            const cardElement = elements.create('card', {style: style, hidePostalCode: true});
            cardElement.mount('#card-element');
     
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
     
            cardButton.addEventListener('click', async (e) => {
                // formのsubmitボタンのデフォルト動作を無効にする
                e.preventDefault();
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                        }
                    }
                );
                
                if (error) {
                // エラー処理
                console.log('error');
                
                } else {
                // 問題なければ、stripePaymentHandlerへ
                stripePaymentHandler(setupIntent);
                }
            });
        }
        
        function stripePaymentHandler(setupIntent) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripePaymentMethod');
        hiddenInput.setAttribute('value', setupIntent.payment_method);
        form.appendChild(hiddenInput);
        // フォームを送信
        form.submit();
        }
    </script>
</x-app-layout>
