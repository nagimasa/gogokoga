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
use App\Models\Comment;
use App\Models\Menu;

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
        $services = Service::with('genre:id,genre_name', 'comments:id,service_id', 'menus:id,service_id')->paginate(15);
        $menus = Menu::select('id', 'service_id')->get();
        $count = Service::count();
        
        // ddd($services);
        return view('admin.services.index', compact('services', 'count',));
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
        $service = Service::find($id);

        return view('admin.services.show', compact('service'));
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
        
        $genres = Genre::all()->pluck('genre_name', 'id');
        $areas = Area::all()->pluck('area_name', 'id');
        $payments = Payment::all()->pluck('payment_name', 'id');
        return view('admin.services.edit', compact('service', 'genres', 'areas', 'payments'));
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

        $service = Service::findOrFail($id);
        $service->genre_id          = $request->genre_id;
        $service->area_id           = $request->area_id;
        $service->service_name      = $request->service_name;
        $service->service_name_kana = $request->service_name_kana;
        $service->email             = $request->email;
        $service->tel               = $request->tel;
        $service->address           = $request->address;
        $service->parking           = $request->parking;
        $service->url               = $request->url;
        $service->googlemap         = $request->googlemap;
        $service->visualize         = $request->visualize;
        $service->another           = $request->another;
        $service->takeout           = $request->takeout;
        $service->seat              = $request->seat;
        $service->first_fee         = $request->first_fee;
        $service->add_fee           = $request->add_fee;
        $service->stay_fee          = $request->stay_fee;
        $service->cancel_fee        = $request->cancel_fee;
        $service->sunday            = $request->sunday;
        $service->monday            = $request->monday;
        $service->tuesday           = $request->tuesday;
        $service->wednesday         = $request->wednesday;
        $service->thursday          = $request->thursday;
        $service->friday            = $request->friday;
        $service->saturday          = $request->saturday;
        $service->regular_holiday   = $request->regular_holiday;
        $service->save();

        if(is_array($request->payments)){
            $service = Service::findOrFail($id);
            $service->payments()->detach();
            $service->payments()->attach($request->payments);

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
        $service = Service::findOrFail($id);
        $service->payments()->detach();
        $service->delete();

        return redirect()->route('admin.services.index');
    }
}
