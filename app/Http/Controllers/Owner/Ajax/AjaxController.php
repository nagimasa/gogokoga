<?php

namespace App\Http\Controllers\Owner\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

use App\Models\Service;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Payment;
use App\Models\Tag;

class AjaxController extends Controller
{
    // 課金を実行
    public function subscribe(Request $request) {

        $user = $request->user();

        if(!$user->subscribed('main')) {

            $payment_method = $request->payment_method;
            $plan = $request->plan;
            $user->newSubscription('main', $plan)->create($payment_method);
            $user->load('subscriptions');

        }

        return $this->status();

    }

    // 課金をキャンセル
    public function cancel(Request $request) {

        $request->user()
            ->subscription('main')
            ->cancel();
        return $this->status();

    }

    // キャンセルしたものをもとに戻す
    public function resume(Request $request) {

        $request->user()
            ->subscription('main')
            ->resume();
        return $this->status();

    }

    // プランを変更する
    public function change_plan(Request $request) {

        $plan = $request->plan;
        $request->user()
            ->subscription('main')
            ->swap($plan);
        return $this->status();

    }

    // カードを変更する
    public function update_card(Request $request) {

        $payment_method = $request->payment_method;
        $request->user()
            ->updateDefaultPaymentMethod($payment_method);
        return $this->status();

    }

    // 課金状態を返す
    public function status() {

        $status = 'unsubscribed';
        $owner=Auth::user();

        $details = [];
        // ddd($owner->subscribed('main'));

        if($owner->subscribed('main')) { // 課金履歴あり

            // $status = 'canceled';
            // 以下のif文が正しく機能していない。statusの情報はちゃんと取得できている
            // 解：cancelledをcanceledに書き換えたところエラーが出なくなった。
            // 　　米英語がcanceledらしい
            if($owner->subscription('main')->canceled()) {  // キャンセル済み

                $status = 'cancelled';

            } else {    // 課金中

                $status = 'subscribed';

            }


            $subscription = $owner->subscriptions->first(function($value){

                return ($value->name === 'main');

            })->only('ends_at', 'stripe_plan');

            $details = [
                'end_date' => ($subscription['ends_at']) ? $subscription['ends_at']->format('Y-m-d') : null,
                'plan' => Arr::get(config('services.stripe.plans'), $subscription['stripe_plan']),
                // 'plan' => Arr::get(config('services.stripe.plans'), $subscription['stripe_plan']),
                'card_last_four' => $owner->pm_last_four
                // 'card_last_four' => $user->card_last_four
            ];

        }

        return [
            'status' => $status,
            'details' => $details
        ];

    }

    
}
