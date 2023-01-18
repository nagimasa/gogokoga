<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Area;

class AreasController extends Controller
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
        // $data_now = Carbon::now();
        // $data_parse = Carbon::parse(now());
        // dd($data_now->year, $data_parse);

        $areas = DB::table('areas')->paginate(15);
        $count = Area::count();

        return view('admin.areas.index', compact('areas', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.areas.create');
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
        $request->validate([
            'area_name'      => 'required|string|max:255',
            'area_name_kana' => 'required|string|max:255',
        ]);

        Area::create([
            'area_name' => $request->area_name,
            'area_name_kana' => $request->area_name_kana,
        ]);


        return redirect()->route('admin.areas.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::find($id);

        return view('admin.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $area = Area::findOrFail($id);
        return view('admin.areas.edit', compact('area'));

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
        $area = Area::findOrFail($id);
        $area->area_name = $request->area_name;
        $area->area_name_kana = $request->area_name_kana;
        $area->save();

        return redirect()->route('admin.areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id)->delete();

        return redirect()->route('admin.areas.index');
    }
}
