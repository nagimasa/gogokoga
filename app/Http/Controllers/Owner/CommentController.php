<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Comment;

class CommentController extends Controller
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
            $id = $request->route()->parameter('service');
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


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('owner.comments.show', compact('comment', 'service'));
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
        return view('owner.comments.edit', compact('comment', 'service'));
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


        $request->validate([
            'comment' => 'max:60',
        ]);


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


        return redirect()->route('owner.comments.show', ["comment" => $id]);
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
        return redirect()->route('owner.comments.show', $id);
    }
}
