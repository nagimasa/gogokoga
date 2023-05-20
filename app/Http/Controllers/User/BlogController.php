<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Blog;

class BlogController extends Controller
{
    public function index($service)
    {
        $blogs = Blog::where('service_id', $service)->get();
        return view('user.blog-list', compact('blogs'));
    }
    public function show($service ,$blog)
    {
        $detail = Blog::find($blog);
        return view('user.blog-detail', compact('detail'));
    }
}
