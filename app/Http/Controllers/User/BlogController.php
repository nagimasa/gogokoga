<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        //
    }
    public function show($id)
    {
        $detail = Blog::find($id);
        // dd($detail);
        return view('user.blog-detail', compact('detail'));
    }
}
