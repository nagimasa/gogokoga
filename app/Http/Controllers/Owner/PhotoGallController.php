<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\PhotoGall;


use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class PhotoGallController extends Controller
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
            // dd($request->route());
            $id = $request->route()->parameter('photogalls');
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


    public function index($id)
    {
        $service = Service::findOrFail($id);
        $photogalls = PhotoGall::where('service_id', $id)->get();
        $count = PhotoGall::where('service_id', $id)->count();

        return view('owner.photogalls.index', compact('photogalls', 'id', 'count', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('owner.photogalls.create', compact('service'));
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
                    1200,
                    null,
                    function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    }
                );

                // 専用のディレクトリがあれば保存、なければ作成して保存
                if(Storage::exists($photogall_directory)){
                    $file->save(storage_path() ."/app/public" ."/". $photogall_images ."/". $each_path ."/". "resized-{$filename}");
                }else{
                    Storage::makeDirectory($photogall_directory, '0644');
                    $file->save(storage_path() ."/app/public". "/". $photogall_images ."/". $each_path ."/". "resized-{$filename}");
                }
                // データベースにデータを保存
                PhotoGall::create([
                    'service_id' => $request->service_id,
                    // 'image_name' => storage_path(). $photogall_images .'/'. $each_path .'/'. "resized-{$filename}",
                    'image_name' => 'storage/' . $photogall_images .'/'. $each_path .'/'. "resized-{$filename}",
                ]);
            }
        }

        return redirect()->route('owner.photogalls.index', $service_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $select_photo)
    {
        // select_photoはRouteで設定した'photogalls/edit/{photogalls}/{photo}'の{photo}を取得している
        $photo = PhotoGall::findOrFail($select_photo);
        $service = Service::findOrFail($photo->service_id);

        return view('owner.photogalls.edit', compact('photo', 'service'));
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
    public function destroy(Request $request, $id, $select_photo)
    {
        $photo = PhotoGall::findOrFail($select_photo);
        $service_id = $photo->service_id;
        // dd($photo, $service_id, $request);


        // ディレクトリをidで分けるための準備
        $each_path = $service_id;


        // 画像のパスを取得
        $image_url = $request->delete_image_name;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'photogall_images' ."/". $each_path ."/". basename($image_url);


        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);
        

        PhotoGall::findOrFail($select_photo)->delete();
        return redirect()->route('owner.photogalls.index', $service_id);
    }
}
