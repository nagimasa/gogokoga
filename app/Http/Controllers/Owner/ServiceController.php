<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Service;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Payment;
use App\Models\Tag;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
     {
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
        // $service = Service::with('tag')->find($id);
        $service = Service::find($id);

        return view('owner.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service  = Service::with('tags')->find($id);
        $genres   = Genre::all()->pluck('genre_name', 'id');
        $areas    = Area::all()->pluck('area_name', 'id');
        $payments = Payment::all()->pluck('payment_name', 'id');

        // ジャンルごとにタグを表示させるため
        $genre_with_tag = Genre::with('tags')->get();
        $tags = Tag::where('genre_id', $service->genre_id)->get();
        // dd($tags);

        return view('owner.services.edit', compact('service', 'genres', 'areas', 'payments', 'genres', 'genre_with_tag', 'tags'));
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


        if(is_array($request->tags)){
            $service = Service::findOrFail($id);
            $service->tags()->detach();
            $service->tags()->attach($request->tags);
        }

        if(is_array($request->payments)){
            $service = Service::findOrFail($id);
            $service->payments()->detach();
            $service->payments()->attach($request->payments);

        }

        return redirect()->route('owner.services.show', compact('service'));
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
