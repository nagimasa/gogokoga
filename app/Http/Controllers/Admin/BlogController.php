<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Service;

// use InterventionImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
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


    public function index($id)
    {

        $service = Service::findOrFail($id);
        $blogs = Blog::where('service_id', $id)->paginate(10);
        $count = Blog::where('service_id', $id)->count();

        return view('admin.blogs.index', compact('blogs', 'count', 'service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        // ddd($service);
        return view('admin.blogs.create', compact('service'));
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
        $blog_images = 'blog_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $blog_directory = 'public/blog_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->blog_image_name;


        // 画像があれば圧縮して保存する処理
        if(!is_null($get_image) && $get_image->isValid()){
            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('blog_image_name');
            // dd($file);
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
            if(Storage::exists($blog_directory)){
                $file->save(storage_path("app/" . "public/". $blog_images ."/". $each_path ."/". "resized-{$filename}"));
            }else{
                Storage::makeDirectory($blog_directory);
                $file->save(storage_path("app/" . "public/". $blog_images ."/". $each_path ."/". "resized-{$filename}"));
            }
        }

        // $blog_images = 'blog_images';
        // $each_path = $request->service_id;
        // $image_name = $request->file('blog_image_name')->getClientOriginalName();
        // $get_image_name = $request->file('blog_image_name')->storeAs('public/' . $blog_images . '/' . $each_path, $image_name); 
        // ddd($get_image_name);

        if(isset($get_image)){
        Blog::create([
            'service_id'      => $request->service_id,
            'blog_title'      => $request->blog_title,
            'blog_text'       => $request->blog_text,
            'blog_image_name' => 'storage/'. $blog_images .'/'. $each_path .'/'. "resized-{$filename}",
        ]);
        }else{
            Blog::create([
            'service_id'      => $request->service_id,
            'blog_title'      => $request->blog_title,
            'blog_text'       => $request->blog_text,
            ]);
        }
        return redirect()->route('admin.blogs.index', $service_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $blogs = Blog::find($id);
        $service = Service::findOrFail($blogs->service_id);
        // ddd($blogs);
        $count = Blog::where('service_id', $id)->count();
                    
        return view('admin.blogs.show', compact('blogs', 'service', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $service = Service::findOrFail($blog->service_id);
        // dd($service);

        return view('admin.blogs.edit', compact('blog', 'service'));
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
        $target_blog = Blog::find($request->id);
        $target_image_url = $target_blog->blog_image_name;


        // サービスidの取得
        $each_path = $request->service_id;


        // ルート情報の１部を設定
        $blog_images = 'blog_images';


        // ディレクトリをidで分けるための準備
        $each_path = $request->service_id;


        // ディレクトリを作成する場合に使用
        $blog_directory = 'public/blog_images' . "/" . $each_path ."/" ;


        // 画像を取得
        $get_image = $request->blog_image_name;


        // 画像があれば圧縮して保存する処理
        if(!is_null($get_image) && $get_image->isValid()){
            // 既存画像を削除
            if($target_image_url == true){
            Storage::delete($target_image_url);
            }

            $filename = now()->format('YmdHis').uniqid('', true) . "." . $get_image->extension();
            $file = $request->file('blog_image_name');
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
            $file->save(storage_path("app/" . "public/". $blog_images ."/". $each_path ."/". "resized-{$filename}"));
        }

        
        if(isset($get_image)){
            // 新規画像があれば上書き保存
            $target_blog->update([
                'blog_title'       => $request->blog_title,
                'blog_text'        => $request->blog_text,
                'blog_image_name'  => 'storage/'. $blog_images .'/'. $each_path . '/' . "resized-{$filename}",
            ]);
        }else{
            // 新規画像がなければ既存のまま
            $target_blog->update([
                'blog_title'       => $request->blog_title,
                'blog_text'        => $request->blog_text,
            ]);
        }


        $blog = Blog::findOrFail($id);

        return redirect()->route('admin.blogs.show', $blog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $service_id = $blog->service_id;


        // ディレクトリをidで分けるための準備
        $each_path = $service_id;


        // 画像のパスを取得
        $image_url = $request->delete_image_name;


        //削除用のパスを作成 basename()でDBに登録されている名前からファイル名のみを取得 
        $delete_path = 'blog_images' ."/". $each_path ."/". basename($image_url);


        // ディスクを指定してファイルを削除
        Storage::disk('public')->delete($delete_path);
        


        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index', $service_id);
    }
}
