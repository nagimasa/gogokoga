<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Service;
use App\Models\Photogall;

// use InterventionImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Log;
class PhotoGallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // dd($id);
        $photogalls = Photogall::where('service_id', $id)->get();
        $count = Photogall::where('service_id', $id)->count();
        // ->orderBy('update_at', 'desc');
        // dd($photogalls);
        // $count = PhotoGall::where('service_id', $id)->count();

        return view('admin.photogalls.index', compact('photogalls', 'id', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.photogalls.create', compact('service'));
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
        $photogall_images = 'photogall_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $photogall_directory = 'public/photogall_images' . "/" . $each_path ."/" ;
        // $photogall_directory = "/app/public". '/photogall_images' . "/" . $each_path ."/" ;
        // dd($photogall_directory);


        // 画像を取得
        $get_images = $request->file('image_name');


        // 複数画像を１つずつにする
        foreach($get_images as $get_image){
            // 画像があれば圧縮して保存する処理
            if(!is_null($get_image) && $get_image->isValid()){
                $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
                $file = $get_image;
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
                if(Storage::exists($photogall_directory)){
                    $file->save(storage_path() ."/app/public" ."/". $photogall_images ."/". $each_path ."/". "resized-{$filename}");
                    // $file->save(storage_path("app/" . "public/". $photogall_images ."/". $each_path ."/". "resized-{$filename}"));
                }else{
                    Storage::makeDirectory($photogall_directory);
                    $file->save(storage_path() ."/app/public". "/". $photogall_images ."/". $each_path ."/". "resized-{$filename}");
                    // $file->save(storage_path("app/" . "public/". $photogall_images ."/". $each_path ."/". "resized-{$filename}"));
                }
                // データベースにデータを保存
                Photogall::create([
                    'service_id' => $request->service_id,
                    // 'image_name' => storage_path(). $photogall_images .'/'. $each_path .'/'. "resized-{$filename}",
                    'image_name' => 'storage/' . $photogall_images .'/'. $each_path .'/'. "resized-{$filename}",
                ]);
            }
        }

        return redirect()->route('admin.photogalls.index', $service_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photogall::findOrFail($id);
        $service = Service::findOrFail($photo->service_id);
        // dd($service);

        return view('admin.photogalls.edit', compact('photo', 'service'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $photo = Photogall::findOrFail($id);
        $service_id = $photo->service_id;


        // ディレクトリをidで分けるための準備
        $each_path = $service_id;


        // 画像のパスを取得
        $image_url = $request->delete_image_name;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'photogall_images' ."/". $each_path ."/". basename($image_url);


        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);
        

        Photogall::findOrFail($id)->delete();
        return redirect()->route('admin.photogalls.index', $service_id);
    }
}
