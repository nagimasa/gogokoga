<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Reqruit;
use App\Models\Owner;


use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ReqruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        // ログイン状態を判定
        $this->middleware('auth:owners');


        //  URLのパラメータを変えたら別のデータが表示されるのを修正（Udemyを参考）
        $this->middleware(function($request, $next){
            // dd($request, $request->route());
            $id = $request->route()->parameter('reqruit');
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


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 認証からオーナーのIDを取得
        $owner_id = Auth::id();

        // オーナーidからレコードを取得
        $owner = Owner::find($owner_id);

        // ownerのservice_idをもとにリレーション先のserviceを取得
        $service = Service::findOrFail($owner->service_id);

        return view('owner.reqruits.create', compact('service', 'owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 認証からオーナーのIDを取得
        $owner_id = Auth::id();

        // オーナーidからレコードを取得
        $owner = Owner::find($owner_id);

        
        // サービスidの取得
        $service_id = $request->service_id;


        // ルート情報の一部を設定
        $reqruit_images = 'reqruit_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $reqruit_directory = 'public/reqruit_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->hero_image;


        // 画像があれば圧縮して保存する処理
        if(!is_null($get_image) && $get_image->isValid()){
            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('hero_image');
            $file = Image::make($file)->setFileInfoFromPath($file);

            // 圧縮
            $file->orientate()->resize(
                600,
                null,
                function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
                }
            );

            // 専用のディレクトリがあれば保存、なければ作成して保存
            if(Storage::exists($reqruit_directory)){
                $file->save(storage_path("app/" . "public/". $reqruit_images ."/". $each_path ."/". "resized-{$filename}"));
            }else{
                Storage::makeDirectory($reqruit_directory);
                $file->save(storage_path("app/" . "public/". $reqruit_images ."/". $each_path ."/". "resized-{$filename}"));
            }
        }

        // バリデーション
        $request->validate([
            'reqruit_title'     => 'max:50',
            'reqruit_text'      => 'required',
            'work_type'         => 'required',
            'work_in_day'       => 'nullable',
            'work_in_week'      => 'nullable',
            'fee_type'          => 'required',
            'fee'               => 'required',
            'address'           => 'required',
            'another'           => 'nullable',
            'maneger_name'      => 'required',
            'maneger_name_kana' => 'required',
            'maneger_tel'       => 'digits_between:8,13|required',
            'maneger_email'     => 'email|nullable',
            'visualize'         => 'required',
            'hero_image'        => 'nullable',
        ]);



        // DBへの保存処理
        if(isset($get_image)){
            Reqruit::create([
                'hero_image'        => 'storage/' . $reqruit_images .'/' .$each_path .'/'. "resized-{$filename}",
                'reqruit_title'     => $request->reqruit_title,
                'reqruit_text'      => $request->reqruit_text,
                'work_type'         => $request->work_type,
                'work_in_day'       => $request->work_in_day,
                'work_in_week'      => $request->work_in_week,
                'fee_type'          => $request->fee_type,
                'fee'               => $request->fee,
                'address'           => $request->address,
                'another'           => $request->another,
                'service_id'        => $request->service_id,
                'maneger_name'      => $request->maneger_name,
                'maneger_tel'       => $request->maneger_tel,
                'maneger_email'     => $request->maneger_email,
                'maneger_name_kana' => $request->maneger_name_kana,
                'visualize'         => $request->visualize,
            ]);
        }else{
            Reqruit::create([
                'reqruit_title'     => $request->reqruit_title,
                'reqruit_text'      => $request->reqruit_text,
                'work_type'         => $request->work_type,
                'work_in_day'       => $request->work_in_day,
                'work_in_week'      => $request->work_in_week,
                'fee_type'          => $request->fee_type,
                'fee'               => $request->fee,
                'address'           => $request->address,
                'another'           => $request->another,
                'service_id'        => $request->service_id,
                'maneger_name'      => $request->maneger_name,
                'maneger_tel'       => $request->maneger_tel,
                'maneger_email'     => $request->maneger_email,
                'maneger_name_kana' => $request->maneger_name_kana,
                'visualize'         => $request->visualize,
            ]);
        }


        return redirect()->route('owner.reqruits.show', $owner->service_id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 認証からオーナーのIDを取得
        $owner_id = Auth::id();

        // オーナーidからレコードを取得
        $owner = Owner::find($owner_id);

        $service = Service::find($owner->service_id);
        $reqruit = Reqruit::where('service_id', $id)->first();
        return view('owner.reqruits.show', compact('reqruit', 'service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $reqruit = Reqruit::where('service_id', $id)->first();
        return view('owner.reqruits.edit', compact('reqruit', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // 対象を設定
        $target_reqruit = Reqruit::find($request->id);
        $target_image_url = $target_reqruit->hero_image;
        

        // サービスidの取得
        $service_id = $request->service_id;


        // ルート情報の１部を設定
        $reqruit_images = 'reqruit_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $reqruit_directory = 'public/reqruit_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->hero_image;
        

        if(!is_null($get_image) && $get_image->isValid()){
            // 既存画像を削除
            if($target_image_url == true){
                Storage::delete($target_image_url);
                }

            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('hero_image');
            $file = Image::make($file)->setFileInfoFromPath($file);

            // 圧縮
            $file->orientate()->resize(
                600,
                null,
                function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
                }
            );

            // 専用のディレクトリがあれば保存、なければ作成して保存
            if(Storage::exists($reqruit_directory)){
                $file->save(storage_path("app/" . "public/". $reqruit_images ."/". $each_path ."/". "resized-{$filename}"));
            }else{
                Storage::makeDirectory($reqruit_directory);
                $file->save(storage_path("app/" . "public/". $reqruit_images ."/". $each_path ."/". "resized-{$filename}"));
            }


            // $file->save(storage_path("app/" . "public/". $reqruit_images ."/". $each_path ."/". "resized-{$filename}"));
        }

        // バリデーション
        $request->validate([
            'reqruit_title'     => 'max:50',
            'reqruit_text'      => 'required',
            'work_type'         => 'required',
            'work_in_day'       => 'nullable',
            'work_in_week'      => 'nullable',
            'fee_type'          => 'required',
            'fee'               => 'required',
            'address'           => 'required',
            'another'           => 'nullable',
            'maneger_name'      => 'required',
            'maneger_name_kana' => 'required',
            'maneger_tel'       => 'digits_between:8,13|required',
            'maneger_email'     => 'email|nullable',
            'visualize'         => 'required',
            'hero_image'        => 'nullable',
        ]);


        
        if(isset($get_image)){
            // 新規画像があれば上書き保存
            $target_reqruit->update([
                'hero_image'        => 'storage/' . $reqruit_images .'/' .$each_path .'/'. "resized-{$filename}",
                'reqruit_title'     => $request->reqruit_title,
                'reqruit_text'      => $request->reqruit_text,
                'work_type'         => $request->work_type,
                'work_in_day'       => $request->work_in_day,
                'work_in_week'      => $request->work_in_week,
                'fee_type'          => $request->fee_type,
                'fee'               => $request->fee,
                'address'           => $request->address,
                'another'           => $request->another,
                'service_id'        => $request->service_id,
                'maneger_name'      => $request->maneger_name,
                'maneger_tel'       => $request->maneger_tel,
                'maneger_email'     => $request->maneger_email,
                'maneger_name_kana' => $request->maneger_name_kana,
                'visualize'         => $request->visualize,
            ]);
        }else{
            // 新規画像がなければ既存のまま
            $target_reqruit->update([
                'reqruit_title'     => $request->reqruit_title,
                'reqruit_text'      => $request->reqruit_text,
                'work_type'         => $request->work_type,
                'work_in_day'       => $request->work_in_day,
                'work_in_week'      => $request->work_in_week,
                'fee_type'          => $request->fee_type,
                'fee'               => $request->fee,
                'address'           => $request->address,
                'another'           => $request->another,
                'service_id'        => $request->service_id,
                'maneger_name'      => $request->maneger_name,
                'maneger_tel'       => $request->maneger_tel,
                'maneger_email'     => $request->maneger_email,
                'maneger_name_kana' => $request->maneger_name_kana,
                'visualize'         => $request->visualize,
            ]);
        }

        return redirect()->route('owner.reqruits.show', $service_id);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reqruit = Reqruit::where('service_id', $id)->first();


        // $reqruit = Reqruit::findOrFail($id);
        $service_id = $reqruit->service_id;


        // ディレクトリをidで分けるための準備
        $each_path = $service_id;


        // 画像のパスを取得
        // $image_url = $reqruit->delete_image_name;
        $image_url = $reqruit->hero_image;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'reqruit_images' ."/". $each_path ."/". basename($image_url);


        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);




        Reqruit::findOrFail($reqruit->id)->delete();
        return redirect()->route('owner.reqruits.show', $id);
    }
}
