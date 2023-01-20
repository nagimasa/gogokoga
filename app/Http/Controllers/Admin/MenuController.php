<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Service;

class MenuController extends Controller
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

        // $menu_id = Menu::find($id);
        $menus = DB::table('menus')->paginate(15);
        $count = Menu::count();

        return view('admin.areas.index', compact('menus', 'count'));
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
        return view('admin.menus.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'moreFields.*.service_id' => 'required',
            'moreFields.*.menu_name' => 'required',
            'moreFields.*.menu_fee' => 'required',
        ]);
        // ddd($request);
        
        
        foreach ($request->moreFields as $key => $value) {
            Menu::create($value);
        }
        return redirect()->route('admin.menus.index');
        // return redirect()->route('admin.menus.create', compact('servive'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ddd($id);
        $service = Service::findOrFail($id);
        $menus = Menu::where('service_id', $id)->get();
        $count = Menu::where('service_id', $id)->count();
                    
        return view('admin.menus.show', compact('menus', 'service', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $menus = Menu::where('service_id', $id)->get();

        return view('admin.menus.edit', compact('service', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'moreFields.*.service_id' => 'required',
            'moreFields.*.menu_name' => 'required',
            'moreFields.*.menu_fee' => 'required',
        ]);
        // ddd($request);
        
        
        foreach ($request->moreFields as $key => $value) {
            Menu::create($value);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
