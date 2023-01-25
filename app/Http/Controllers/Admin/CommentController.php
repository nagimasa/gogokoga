<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Service;

class CommentController extends Controller
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
        $comment = Comment::where('service_id', $id)->get();

        return view('admin.blogs.index', compact('comment','service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $service = Service::find($id);
        $comment = Comment::where('service_id', $id)->first();
        // dd($comment);
        return view('admin.comments.show', compact('comment', 'service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $comment = Comment::where('service_id', $id)->first();
        return view('admin.comments.edit', compact('comment', 'service'));
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

        $comment = Comment::where('service_id', $id)->first();

        if( empty($comment) ){
        Comment::create([
            'service_id' => $request->service_id,
            'comment'    => $request->comment,
        ]);
        }else{
            $comment->update([
                'service_id' => $request->service_id,
                'comment'    => $request->comment,
            ]);
        }


        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $comment = Comment::where('service_id', $id)->first();
        Comment::findOrFail($comment->id)->delete();
        return redirect()->route('admin.comments.show', $id);
    }
}
