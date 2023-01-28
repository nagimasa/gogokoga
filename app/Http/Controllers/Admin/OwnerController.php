<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Owner;
use App\Models\Service;

class OwnerController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.owners.create', compact('service'));
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




         Owner::create([
            'service_id' => $request->service_id,
            'name'       => $request->name,
            'name_kana'  => $request->name_kana,
            'email'      => $request->email,
            'owner_tel'  => $request->owner_tel,
            'another'    => $request->another,
            'password'   => $request->password,
         ]);

         return redirect()->route('admin.owners.show', $service_id);
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
        return view('admin.owners.show', compact('owner', 'service'));
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
        return view('admin.owners.edit', compact('owner', 'service'));
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
        
        $owner->update([
            'service_id' => $request->service_id,
            'name'       => $request->name,
            'name_kana'  => $request->name_kana,
            'email'      => $request->email,
            'owner_tel'  => $request->owner_tel,
            'another'    => $request->another,
            'password'   => $request->password,
         ]);


         return redirect()->route('admin.owners.show', $service_id);
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
        return redirect()->route('admin.owners.show', $id);
    }
}
