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

        $gall_images = 'gall_images';
        $each_path = $request->service_id;



        // Udemyの方法
        // $get_images = $request->image_name;
        $get_images = $request->file('image_name');
        $root_image = 'public/' . $gall_images . '/' . $each_path;
        // foreach($get_images as $get_image){
        //     if(!is_null($get_image) && $get_image->isValid()){
        //         $resized_image = Image::make($get_image);
        //         $resized_image->orientate();
        //         $resized_image->resize(600, null,
        //         function($constraint){
        //             $constraint->aspectRatio();
        //             $constraint->upsize();
        //         })->encode();
        //         Storage::put($root_image . $get_image, $resized_image);
        //         $service_id = $request->service_id;

        //         // データベースにデータを保存
        //         Photogall::create([
        //             'service_id' => $request->service_id,
        //             'image_name' => 'storage/'. $gall_images .'/'. $each_path  . $get_image,
        //         ]);
        //     }
        // }
        foreach($get_images as $get_image){
            // dd($get_images, $get_image);
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
                $file->save(storage_path(). "/app/public/". $gall_images ."/". $each_path ."/". "resized-{$filename}");
                $service_id = $request->service_id;
                // データベースにデータを保存
                Photogall::create([
                    'service_id' => $request->service_id,
                    'image_name' => 'storage/'. $gall_images .'/'. $each_path .'/'. "resized-{$filename}",
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
    public function destroy($id)
    {
        $photo = Photogall::findOrFail($id);
        $service_id = $photo->service_id;

        Photogall::findOrFail($id)->delete();
        return redirect()->route('admin.photogalls.index', $service_id);
    }
}
