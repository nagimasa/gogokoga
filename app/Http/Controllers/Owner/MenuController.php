<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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
        // ログイン状態を判定
        $this->middleware('auth:owners');


        // URLのパラメータを変えたら別のデータが表示されるのを修正（Udemyを参考）
        $this->middleware(function($request, $next){
            // dd($request->route());
            $id = $request->route()->parameter('menu');
            if(!is_null($id)){
                $service_owner_id = Service::findOrFail($id)->owner->id;
                $service_id = (int)$service_owner_id;
                $owner_id = Auth::id();
                // dd($service_id, $owner_id);
                if($service_id !== $owner_id){
                    abort(404);
                }
            }
            return $next($request);
         });
     }



    public function index()
    {
        $menus = DB::table('menus')->paginate(15);
        $count = Menu::count();

        return view('owner.menus.index', compact('menus', 'count'));
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
        return view('owner.menus.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        foreach($request->moreFields as $key => $value) {
            // dd($value['menu_name']);
            if($value['menu_name'] == true && $value['menu_fee'] == true){
                $value['menu_fee'] = mb_convert_kana($value['menu_fee'],'n','utf-8');
            $request->validate([
                'moreFields.*.menu_name' => 'required',
                'moreFields.*.menu_fee' => 'required|numeric',
            ]);
                Menu::create($value);
            }
            elseif($value['menu_name'] == null || $value['menu_fee'] == null){
                return back();
            }
        }
        

        return redirect()->route('owner.menus.show', $value['service_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        $menus = Menu::where('service_id', $id)->get();
        $count = Menu::where('service_id', $id)->count();
                    // dd($service, $menus, $count);
        return view('owner.menus.show', compact('menus', 'service', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $select_menu)
    {
        $menu = Menu::findOrFail($select_menu);
        $service = Service::findOrFail($id, ['id', 'service_name']);
        // dd($id, $select_menu, $menu, $service);

        return view('owner.menus.edit', compact('menu', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $select_menu)
    {
        // dd($request, $select_menu);
        $menu = Menu::findOrFail($select_menu);
        $menu->menu_name = $request->menu_name;
        $menu->menu_fee = $request->menu_fee;
        $menu->save();

        return redirect()->route('owner.menus.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $select_menu)
    {
        // dd($request, $select_menu, $id);
        $menu = Menu::findOrFail($select_menu);
        $service_id = $menu->service_id;

        Menu::findOrFail($select_menu)->delete();
        return redirect()->route('owner.menus.show', $service_id);
    }
}
