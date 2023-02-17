<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Owner;

class StripeController extends Controller
{
    public function __construct()
    {
       // ログイン状態を判定
       $this->middleware('auth:owners');


       //  URLのパラメータを変えたら別のデータが表示されるのを修正（Udemyを参考）
       $this->middleware(function($request, $next){
           // dd($request->route());
           $id = $request->route()->parameter('service');
           if(!is_null($id)){
               $service_owner_id = Service::findOrFail($id)->owner->id;
               $service_id = (int)$service_owner_id;
               $owner_id = Auth::id();
               if($service_id !== $owner_id){
                   abort(404);
               }
           }
           return $next($request);
        });
    }


    public function subscription(Request $request){

        // ログインユーザーを$userとする
        $owner=Auth::user();
        return view('owner.stripe.subscription', compact('owner'),['intent' => $owner->createSetupIntent()]);
      
    }


    public function afterpay(Request $request){
        // ログインユーザーを$userとする
        $owner=Auth::user();
 
        // またStripe顧客でなければ、新規顧客にする
        $stripeCustomer = $owner->createOrGetStripeCustomer();
 
        // フォーム送信の情報から$paymentMethodを作成する
        $paymentMethod=$request->input('stripePaymentMethod');
 
        // プランはconfigに設定したbasic_plan_idとする
        $plan=config('services.stripe.basic_plan_id');
        
        // 上記のプランと支払方法で、サブスクを新規作成する
        $owner->newSubscription('default', $plan)
        ->create($paymentMethod);
 
        // 処理後に'ルート設定'にページ移行
        return redirect()->route('ルート設定');
    }



}
