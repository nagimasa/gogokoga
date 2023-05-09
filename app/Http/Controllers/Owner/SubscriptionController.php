<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Service;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Payment;
use App\Models\Tag;


class SubscriptionController extends Controller
{    public function __construct()
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


    public function index(Request $request) {

        $owner=Auth::user();
        $user = $request->user();
        // ddd($owner->subscribed('main'), $user->subscribed('main'));
        // ddd($owner->subscription('main'), $owner);
        return view('owner.subscription.index')->with([
            'intent' => $user->createSetupIntent()
        ]);

    }
}