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

        $blog_images = 'blog_images';
        $each_path = $request->service_id;
        // $image_name = $request->file('blog_image_name')->getClientOriginalName();


        // Udemyの方法
        $get_image = $request->blog_image_name;
        // dd($get_image);
        // $root_image = 'public/' . $blog_images . '/' . $each_path . $image_name;
        $root_image = 'public/' . $blog_images . '/' . $each_path;
        if(!is_null($get_image) && $get_image->isValid()){
            // $extension = $get_image->extension();
            $resized_image = Image::make($get_image);
            $resized_image->orientate();
            $resized_image->resize(600, null,
            function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();
            Storage::put($root_image . $get_image, $resized_image);
        }



        // $blog_images = 'blog_images';
        // $each_path = $request->service_id;
        // $image_name = $request->file('blog_image_name')->getClientOriginalName();
        // $get_image_name = $request->file('blog_image_name')->storeAs('public/' . $blog_images . '/' . $each_path, $image_name); 
        // ddd($get_image_name);

        $service_id = $request->service_id;
        Blog::create([
            'service_id' => $request->service_id,
            'blog_title' => $request->blog_title,
            'blog_text' => $request->blog_text,
            'blog_image_name' => 'storage/'. $blog_images .'/'. $each_path . '/' . $get_image,
        ]);
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
        $target_blog = Blog::find($request->id);
        $target_image_url = $target_blog->blog_image_name;

        $blog_images = 'blog_images';
        $each_path = $request->service_id;


        // 画像のアップロードを取得
        $get_image = $request->blog_image_name;
        // ルート情報を設定
        $root_image = 'public/' . $blog_images . '/' . $each_path;


        // 画像がアップされていたら
        if(!is_null($get_image) && $get_image->isValid()){
            // 既存画像を削除
            Storage::delete($target_image_url);
            // 新規画像の保存処理
            $resized_image = Image::make($get_image);
            $resized_image->orientate();
            $resized_image->resize(600, null,
            function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();
            Storage::put($root_image . $get_image, $resized_image);
        }

        
        if(isset($get_image)){
            // 新規画像があれば上書き保存
            $target_blog->update([
                'blog_title'       => $request->blog_title,
                'blog_text'        => $request->blog_text,
                'blog_image_name'  => 'storage/'. $blog_images .'/'. $each_path . '/' . $get_image,
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
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $service_id = $blog->service_id;

        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index', $service_id);
    }
}
