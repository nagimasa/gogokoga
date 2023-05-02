
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script>

    new Vue({
        el: '#app',
        data: {
            stripe: null,
            stripeCard: null,
            publicKey: '{{ config('services.stripe.pb_key') }}',
            status: '',
            cardHolderName: '',
            details: {},
            plan: '',
            planOptions: {!! json_encode(config('services.stripe.plans')) !!}
        },
        methods: {
            async subscribe(e) {

                const paymentMethod = await this.getPaymentMethod(e.target);
                const url = '/owner/ajax/subscription/subscribe';
                const params = {
                    payment_method: paymentMethod,
                    plan: this.plan
                };
                axios.post(url, params)
                    .then(response => {

                        location.reload();

                    });

            },
            cancel() {

                const url = '/owner/ajax/subscription/cancel';
                axios.post(url)
                    .then(this.setStatus);

            },
            resume() {

                const url = '/owner/ajax/subscription/resume';
                axios.post(url)
                    .then(this.setStatus);

            },
            changePlan() {

                const url = '/owner/ajax/subscription/change_plan';
                const params = { plan: this.plan };
                axios.post(url, params)
                    .then(this.setStatus);

            },
            async updateCard(e) {

                const paymentMethod = await this.getPaymentMethod(e.target);
                const url = '/owner/ajax/subscription/update_card';
                const params = { payment_method: paymentMethod };
                axios.post(url, params)
                    .then(response => {

                        location.reload();

                    });

            },
            setStatus(response) {

                this.status = response.data.status;
                this.details = response.data.details;

            },
            async getPaymentMethod(target) {

                const clientSecret = target.dataset.secret;
                const { setupIntent, error } = await this.stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: this.stripeCard,
                            billing_details: { name: this.cardHolderName }
                        }
                    }
                );

                if (error) {

                    console.log(error);

                } else {

                    return setupIntent.payment_method;

                }

            }
        },
        computed: {
            isSubscribed() {

                return (this.status === 'subscribed' || this.status === 'cancelled');

            },
            isCancelled() {

                return (this.status === 'cancelled');

            }
        },
        watch: {
            status(value) {

                Vue.nextTick(() => {

                    if(!this.isCancelled) {

                        const selector = (value === 'unsubscribed') ? '#new-card' : '#update-card';
                        this.stripeCard = this.stripe.elements().create('card', {
                            hidePostalCode: true
                        });
                        this.stripeCard.mount(selector);

                    }

                });

            }
        },
        mounted() {

            this.stripe = Stripe(this.publicKey);
            const url = '/owner/ajax/subscription/status';
            axios.get(url)
                .then(this.setStatus);

        }
    });

</script>