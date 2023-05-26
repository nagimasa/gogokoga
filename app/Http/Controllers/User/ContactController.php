<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactSendMail;


class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }

    public function confirm(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'service_name'  => 'required',
            'name'          => 'required',
            'kana_name'     => 'required',
            'tel'           => 'required',
            'email'         => 'required|email',
            'email_confirm' => 'required|email',
            'content'       => 'required',
        ]);
        
        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request
        ->only(['service_name', 'name', 'kana_name', 'tel', 'email', 'email_confirm', 'content']);
        //入力内容確認ページのviewに変数を渡して表示
        return view('user.confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'service_name'  => 'required',
            'name'          => 'required',
            'kana_name'     => 'required',
            'tel'           => 'required',
            'email'         => 'required|email',
            'email_confirm' => 'required|email',
            'content'       => 'required',
        ]);

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');
        
        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

        return view('user.thanks');

        //actionの値で分岐
        // if($action !== 'submit'){
        //     return redirect()
        //         ->route('user.contact.index')
        //         ->withInput($inputs);

        // } else {
        //     //入力されたメールアドレスにメールを送信
        //     Mail::to($inputs['email'])->send(new ContactSendmail($inputs));

        //     //再送信を防ぐためにトークンを再発行
        //     $request->session()->regenerateToken();

        //     //送信完了ページのviewを表示
        //     return view('contact.thanks');

        // }
    }
}
