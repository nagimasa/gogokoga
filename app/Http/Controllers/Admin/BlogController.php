<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Service;

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
        $blogs = Blog::where('service_id', $id)->paginate();
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
        // dd($request);
        $service_id = $request->service_id;
        Blog::create([
            'service_id' => $request->service_id,
            'blog_title' => $request->blog_title,
            'blog_text' => $request->blog_text,
            'blog_image_name' => $request->blog_iamge_name,
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

        $blog = Blog::findOrFail($id);
        $blog->blog_title = $request->blog_title;
        $blog->blog_text = $request->blog_text;
        $blog->blog_image_name = $request->blog_image_name;
        $blog->save();

        return redirect()->route('admin.blogs.show', $blog['service_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_id = Blog::findOrFail($id)->value('service_id');
        Blog::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index', $blog_id);
    }
}
