<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Payment;

class ServiceController extends Controller
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

        $services = Service::with('genre')->paginate(15);
        // $services = DB::table('services')->paginate(15);
        // $services = Service::with('genre')->paginate(15);
        $count = Service::count();
        // ddd($services);
        return view('admin.services.index', compact('services', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $genres = Genre::select('id','genre_name')->get();
        // 上のやり方だとコレクション型で全てが表示されてしまうから下のやり方で取得表示する
        $genres = Genre::all()->pluck('genre_name', 'id');
        $areas = Area::all()->pluck('area_name', 'id');
        $payments = Payment::all()->pluck('payment_name', 'id');

        // ddd($genres, $areas);
        return view('admin.services.create', compact('genres', 'areas', 'payments'));
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
            'genre_id'          => 'required',
            'area_id'           => 'required',
            'service_name'      => 'required',
            'service_name_kana' => 'required',
            'email'             => 'email|nullable',
            'tel'               => 'nullable',
            'address'           => 'nullable',
            'parking'           => 'nullable',
            'url'               => 'url|nullable',
            'googlemap'         => 'url|nullable',
            'visualize'         => 'boolean',
            'another'           => 'nullable',
            'takeout'           => 'boolean',
            'seat'              => 'nullable',
            'first_fee'         => 'nullable',
            'add_fee'           => 'nullable',
            'stay_fee'          => 'nullable',
            'cancel_fee'        => 'nullable',
            'sunday'            => 'nullable',
            'monday'            => 'nullable',
            'tuesday'           => 'nullable',
            'wednesday'         => 'nullable',
            'thursday'          => 'nullable',
            'friday'            => 'nullable',
            'saturday'          => 'nullable',
            'regular_holiday'   => 'nullable',
            'another'           => 'nullable',
        ]);

        Service::create([
            'genre_id'          => $request->genre_id,
            'area_id'           => $request->area_id,
            'service_name'      => $request->service_name,
            'service_name_kana' => $request->service_name_kana,
            'email'             => $request->email,
            'tel'               => $request->tel,
            'address'           => $request->address,
            'parking'           => $request->parking,
            'url'               => $request->url,
            'googlemap'         => $request->googlemap,
            'visualize'         => $request->visualize,
            'another'           => $request->another,
            'takeout'           => $request->takeout,
            'seat'              => $request->seat,
            'first_fee'         => $request->first_fee,
            'add_fee'           => $request->add_fee,
            'stay_fee'          => $request->stay_fee,
            'cancel_fee'        => $request->cancel_fee,
            'sunday'            => $request->sunday,
            'monday'            => $request->monday,
            'tuesday'           => $request->tuesday,
            'wednesday'         => $request->wednesday,
            'thursday'          => $request->thursday,
            'friday'            => $request->friday,
            'saturday'          => $request->saturday,
            'regular_holiday'   => $request->regular_holiday,
            'another'           => $request->another,

        ]);

        return redirect()->route('admin.services.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
