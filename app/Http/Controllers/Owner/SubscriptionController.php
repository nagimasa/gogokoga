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
{
    public function index(Request $request) {

        $user_test = auth()->user();
        $user = $request->user();
        // dd($user);
        // ddd($user_test->subscribed('main'), $user_test);
        return view('owner.subscription.index')->with([
            'intent' => $user->createSetupIntent()
        ]);

    }
}