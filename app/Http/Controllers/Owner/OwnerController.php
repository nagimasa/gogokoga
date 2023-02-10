<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Service;
use App\Models\Owner;

class OwnerController extends Controller
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
            $id = $request->route()->parameter('owner');
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
        $owner = Owner::where('service_id', $id)->first();
        // dd($comment);
        return view('owner.owners.show', compact('owner', 'service'));
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
        $owner = Owner::where('service_id', $id)->first();
        return view('owner.owners.edit', compact('owner', 'service'));
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
        $owner = Owner::where('service_id', $id)->first();

        $service_id = $request->service_id;
        


        $request->validate([
            'name'      => 'max:60|required',
            'name_kana' => 'max:60|required',
            'email'     => 'email|required',
            'owner_tel' => 'digits_between:8,15|required',
            'anothoer'  => 'nullable',
            'password ' => 'unique:App\Owner,password',
        ]);


        $owner->update([
            'service_id' => $request->service_id,
            'name'       => $request->name,
            'name_kana'  => $request->name_kana,
            'email'      => $request->email,
            'owner_tel'  => $request->owner_tel,
            'another'    => $request->another,
            'password'   => Hash::make($request->password),
         ]);


         return redirect()->route('owner.owners.show', $service_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $owner = Owner::where('service_id', $id)->first();
        Owner::findOrFail($owner->id)->delete();
        return redirect()->route('owner.owners.show', $id);
    }
}
