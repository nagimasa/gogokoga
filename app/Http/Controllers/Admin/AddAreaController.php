<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Service;
use App\Models\Addarea;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class AddAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:admin');
     }

    public function index()
    {
        // dd($id);
        // $service = Service::findOrFail($id);
        $add_areas = Addarea::all();

        $add_top      = Addarea::whereBetween('add_area',[0, 0])->get();
        $add_category = Addarea::whereBetween('add_area',[1, 4])->get();
        $add_cars     = Addarea::whereBetween('add_area',[5, 8])->get();
        $add_bottom   = Addarea::whereBetween('add_area',[9,12])->get();
        // dd($add_top, $add_category, $add_cars, $add_bottom);

        return view('admin.addareas.index', compact('add_areas', 'add_top', 'add_category', 'add_cars', 'add_bottom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all()->pluck('service_name', 'id');
        $area_number = [
            'TOP上部'     => ['0' => 'TOP上部'],
            'カテゴリ上部' => ['1' => '左上', '2' => '右上','3' => '左下','4' => '右下'],
            '交通上部'     => ['5' => '左上', '6' => '右上','7' => '左下','8' => '右下'],
            'TOP下部'     => ['9' => '左上', '10' => '右上','11' => '左下','12' => '右下'],
        ];
        // dd($services);

        return view('admin.addareas.create', compact('area_number', 'services'));
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
        // $service_id = $request->service_id;


        // ルート情報の１部を設定
        $addarea_images = 'addarea_images';


        // ディレクトリを作成する場合に使用
        $addarea_directory = 'public/addarea_images' . "/";

        // 画像を取得
        $get_image = $request->file('add_area_image');


        if(!is_null($get_image) && $get_image->isValid()){
            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $get_image;
            $file = Image::make($file)->setFileInfoFromPath($file);

            // 専用のディレクトリがあれば保存、なければ作成して保存
            if(Storage::exists($addarea_directory)){
                $file->save(storage_path() ."/app/public" ."/". $addarea_images ."/". $filename);
            }else{
                Storage::makeDirectory($addarea_directory);
                $file->save(storage_path() ."/app/public". "/". $addarea_images ."/". $filename);
            }
            // データベースにデータを保存
            Addarea::create([
                'service_id' => $request->service_id,
                'add_area' => $request->add_area,
                'add_area_image' => 'storage/' . $addarea_images .'/'. $filename,
            ]);
        }


        return redirect()->route('admin.addareas.index');
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
        $add_area = Addarea::findOrFail($id);
        $service = Service::findOrFail($add_area->service_id);
        // dd($service);

        return view('admin.addareas.edit', compact('add_area', 'service'));
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
        // $add_area = Addarea::findOrFail($id);
        // $service_id = $add_area->service_id;


        // 画像のパスを取得
        $image_url = $request->add_area_image;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'addarea_images' ."/". basename($image_url);


        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);
        
        Addarea::findOrFail($id)->delete();
        return redirect()->route('admin.addareas.index');
    }
}
