<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Genre;
use App\Models\Service;
use App\Models\Area;


class UserController extends Controller
{

    public function index()
    {
        $genres = Genre::select('id', 'genre_name')->get();
        $areas = Area::select('id', 'area_name')->get();

        return view('user.index', compact('genres', 'areas'));
    }
    

    public function search( Request $request)
    {

        $services = Service::with('genre:id,genre_name', 'comments:id,service_id', 'menus:id,service_id')->paginate(10);
        $genres = Genre::select('id', 'genre_name')->get();
        $areas = Area::select('id', 'area_name')->get();


        $keyword  = $request->input('keyword'); //事業名の値
        $genre_id = $request->input('genre_id'); //ジャンルの値
        $area_id  = $request->input('area_id'); //地域の値

        $query = Service::query();
        //キーワードが入力された場合、一致する事業を$queryに代入
        if (isset($keyword)) {
            $query->where('service_name', 'like', '%' . self::escapeLike($keyword) . '%');
        }
        //カテゴリが選択された場合、genre_idが一致する商品を$queryに代入
        if (isset($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
        //地域が選択された場合、area_idが一致する商品を$queryに代入
        if (isset($area_id)) {
            $query->where('area_id', $area_id);
        }

        //$queryをcategory_idの昇順に並び替えて$productsに代入
        $search_services = $query->orderBy('id', 'asc')->paginate(5);


        
        // ddd($services);
        return view('user.search', compact('search_services', 'services', 'genres', 'areas'));
    }
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}
