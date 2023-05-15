<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Phototop;


use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class PhotoTopController extends Controller
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
            $id = $request->route()->parameter('phototop');
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
        $phototop = Phototop::where('service_id', $id)->get();

        return view('owner.phototop.index', compact('phototop', 'id', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('owner.phototop.create', compact('service'));
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
        $phototop_images = 'phototop_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $phototop_directory = 'public/phototop_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->file('top_image_name');
        // ddd($service_id, $phototop_images, $each_path, $phototop_directory, $get_image, $request);
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
            if(Storage::exists($phototop_directory)){
                $file->save(storage_path() ."/app/public" ."/". $phototop_images ."/". $each_path ."/". "resized-{$filename}");
            }else{
                Storage::makeDirectory($phototop_directory);
                $file->save(storage_path() ."/app/public". "/". $phototop_images ."/". $each_path ."/". "resized-{$filename}");
            }
            // データベースにデータを保存
            PhotoTop::create([
                'service_id' => $request->service_id,
                // 'image_name' => storage_path(). $photogall_images .'/'. $each_path .'/'. "resized-{$filename}",
                'top_image_name' => 'storage/' . $phototop_images .'/'. $each_path .'/'. "resized-{$filename}",
            ]);
        }

        return redirect()->route('owner.phototop.index', $service_id);
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
        //
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
    public function destroy($id)
    {
        //
    }
}
