<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Service;

// use InterventionImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.coupons.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // サービスidの取得
        $service_id = $request->service_id;


        // ルート情報の１部を設定
        $coupon_images = 'coupon_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $coupon_directory = 'public/coupon_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->coupon_image;


        // 画像があれば圧縮して保存する処理
        if(!is_null($get_image) && $get_image->isValid()){
            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('coupon_image');
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
            if(Storage::exists($coupon_directory)){
                $file->save(storage_path("app/" . "public/". $coupon_images ."/". $each_path ."/". "resized-{$filename}"));
            }else{
                Storage::makeDirectory($coupon_directory);
                $file->save(storage_path("app/" . "public/". $coupon_images ."/". $each_path ."/". "resized-{$filename}"));
            }
        }


        // DBへの保存処理
        if(isset($get_image)){
            Coupon::create([
                'coupon_image'   => 'storage/' . $coupon_images .'/' .$each_path .'/'. "resized-{$filename}",
                'coupon_title' => $request->coupon_title,
                'coupon_text'  => $request->coupon_text,
                'service_id'   => $request->service_id,
                'visualize'    => $request->visualize,
            ]);
        }else{
            Coupon::create([
                'coupon_title' => $request->coupon_title,
                'coupon_text'  => $request->coupon_text,
                'service_id'   => $request->service_id,
                'visualize'    => $request->visualize,
        ]);
        }


        return redirect()->route('admin.coupons.show', $service_id);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        $coupon = Coupon::where('service_id', $id)->first();
        // dd($comment);
        return view('admin.coupons.show', compact('service', 'coupon'));
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
        $coupon = Coupon::where('service_id', $id)->first();
        return view('admin.coupons.edit', compact('coupon', 'service'));
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
        $target_coupon = Coupon::find($request->id);
        $target_image_url = $target_coupon->coupon_image;


        // サービスidの取得
        $service_id = $request->service_id;


        // ルート情報の１部を設定
        $coupon_images = 'coupon_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // 画像を取得
        $get_image = $request->coupon_image;

        
        // 画像があれば圧縮して保存する処理
        if(!is_null($get_image) && $get_image->isValid()){
            // 既存画像を削除
            if($target_image_url == true){
                Storage::delete($target_image_url);
                }

            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('coupon_image');
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
            $file->save(storage_path("app/" . "public/". $coupon_images ."/". $each_path ."/". "resized-{$filename}"));
        }


        // DBへの保存処理
        if(isset($get_image)){
            $target_coupon->update([
                'coupon_image'   => 'storage/' . $coupon_images .'/' .$each_path .'/'. "resized-{$filename}",
                'coupon_title' => $request->coupon_title,
                'coupon_text'  => $request->coupon_text,
                'service_id'   => $request->service_id,
                'visualize'    => $request->visualize,
            ]);
        }else{
            $target_coupon->update([
                'coupon_title' => $request->coupon_title,
                'coupon_text'  => $request->coupon_text,
                'service_id'   => $request->service_id,
                'visualize'    => $request->visualize,
        ]);
        }

        
        return redirect()->route('admin.coupons.show', $service_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::where('service_id', $id)->first();


        // $reqruit = Reqruit::findOrFail($id);
        $service_id = $coupon->service_id;


        // ディレクトリをidで分けるための準備
        $each_path = $service_id;


        // 画像のパスを取得
        // $image_url = $reqruit->delete_image_name;
        $image_url = $coupon->coupon_image;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'coupon_images' ."/". $each_path ."/". basename($image_url);



        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);


        Coupon::findOrFail($coupon->id)->delete();
        return redirect()->route('admin.coupons.show', $id);
    }
}
