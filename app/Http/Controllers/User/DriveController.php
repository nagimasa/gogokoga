<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;


class DriveController extends Controller
{
    //

    public function index($category)
    {
        // URLのクエリパラメータからcategory（genre）を取得し、switch構文で判別。
        // それにあわせて動的にカテゴリページを表示。
        switch($category){
            case $category === 'drive';
            $services = Service::where('genre_id', 12)->get();
            // dd($services);
                return view('user.drive', compact('services'));
                break;

            case $category === 'taxi';
            $services = Service::where('genre_id', 13)->get();
                return view('user.drive', compact('services'));
                break;
        }
    }
    public function detail($id)
    {
        $detail = Service::find($id);
        return view('user.drive-detail', compact('detail'));
    }



    public function taxi()
    {
        
    }
    public function taxi_detail()
    {
        
    }
}
