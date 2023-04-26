<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>
    <div id="app" class="container">
        <h1 class="mb-4">Stripeを使った月額課金・サンプル</h1>
        <div class="row">
            <div class="offset-3 col-6">
                <div class="card mb-4">
                    <div class="card-body bg-light">
                        <div v-if="!isSubscribed">
                            <div class="form-group">
                                <select class="form-control" v-model="plan">
                                    <option v-for="(value,key) in planOptions" :value="key" v-text="value"></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="cardHolderName" placeholder="名義人（半角ローマ字）">
                            </div>
                            <div class="form-group" style="background-color: white;">
                                <div id="new-card" class="bg-white form-control"></div>
                            </div>
                            <div class="form-group text-right">
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-secret="{{ $intent->client_secret }}"
                                    @click="subscribe">
                                    課金する
                                </button>
                            </div>
                        </div>
                        <div v-else-if="isSubscribed">
                            <div v-if="isCancelled">
                                キャンセル済みです。（終了：<span v-text="details.end_date"></span>）
                                <button class="btn btn-info" type="button" @click="resume">元に戻す</button>
                            </div>
                            <!-- 課金中 -->
                            <div v-else>
                                <div class="mb-3">現在、課金中です。</div>
                                <button class="btn btn-warning" type="button" @click="cancel">キャンセル</button>
                                <hr>
                                <div class="form-group">
                                    課金中のプラン： <span v-text="details.plan"></span>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" v-model="plan">
                                        <option v-for="(value,key) in planOptions" :value="key" v-text="value"></option>
                                    </select><br>
                                    <button class="btn btn-success" type="button" @click="changePlan">プランを変更する</button>
                                </div>
                                <hr>
                                <div class="form-group">
                                    カード情報（下４桁）： <span v-text="details.card_last_four"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="cardHolderName" placeholder="名義人（半角ローマ字）">
                                </div>
                                <div class="form-group">
                                    <div id="update-card" class="bg-white"></div><br>
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-secret="{{ $intent->client_secret }}"
                                        @click="updateCard">
                                        クレジットカードを変更する
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5>テスト入力について</h5>
                        <hr>
                        <strong>名義人：</strong> 半角ローマ字ならなんでもOK<br>
                        <strong>カード番号：</strong> <a href="https://stripe.com/docs/testing#cards" target="_blank">テスト用のカード番号</a>に用意されています。なお、年/月は未来の日付ならいつでもOKで、CVCも数字ならなんでもOKです。
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
@include('layouts.subsc-js')
