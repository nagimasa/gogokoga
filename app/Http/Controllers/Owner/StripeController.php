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

use Symfony\Component\HttpFoundation\Response;
use Laravel\Cashier\Subscription;
use Carbon\Carbon;



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
        return redirect()->route('owner.dashboard');
    }



    public function portal(Owner $owner, Request $request){
        return $request->user()->redirectToBillingPortal(route('owner.dashboard'));
        // return redirect('https://billing.stripe.com/p/login/test_fZecO96nf6gw0OA4gg');
     }


     public function handleCustomerSubscriptionDeleted(array $payload){
        // Stripeから送信されたデータからstripe_idを取得し、$id変数に代入
        $id=$payload['data']['object']['id'];
 
        // Subscriptionテーブルのstripe_idが$idと同じものを取ってくる
        $subsc = Subscription::where('stripe_id', $id)->first();
        
        // このデータのstripe_statusをcanceledにする
        $subsc->stripe_status='canceled';
        
        // このデータのends_atに、Carbonを使って今の時間を入れる
        $subsc->ends_at=Carbon::now()->timestamp;
 
        $subsc->save();
        return new Response('Webhook Handled', 200);
    }

    


     public function webhook(){
        // webhook.php
        //
        // Use this sample code to handle webhook events in your integration.
        //
        // 1) Paste this code into a new file (webhook.php)
        //
        // 2) Install dependencies
        //   composer require stripe/stripe-php
        //
        // 3) Run the server on http://localhost:4242
        //   php -S localhost:4242
        
        require 'vendor/autoload.php';
        
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_10cb744da253f0b76405fcd61a35eb3539b3e304e053078f502ba65204a8f8c0';
        
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        
        try {
          $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
          );
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
          http_response_code(400);
          exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
          // Invalid signature
          http_response_code(400);
          exit();
        }
        
        // Handle the event
        switch ($event->type) {
            case 'customer.deleted':
              $customer = $event->data->object;
            case 'customer.updated':
              $customer = $event->data->object;
            case 'customer.subscription.deleted':
              $subscription = $event->data->object;
            case 'customer.subscription.updated':
              $subscription = $event->data->object;
            case 'invoice.payment_action_required':
              $invoice = $event->data->object;
            // ... handle other event types
            default:
              echo 'Received unknown event type ' . $event->type;
          }
        
        http_response_code(200);
     }


}
