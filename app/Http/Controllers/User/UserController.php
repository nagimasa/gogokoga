<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Genre;
use App\Models\Service;
use App\Models\Area;
use App\Models\Payment;
use App\Models\Reqruit;
use App\Models\Blog;


class UserController extends Controller
{

    public function index()
    {
        $genres = Genre::select('id', 'genre_name')->get();
        $areas = Area::select('id', 'area_name')->get();

        $blogs = Blog::select('blog_title', 'created_at', 'service_id', 'blog_text')
                ->with('service')
                ->latest('created_at')
                ->take(10)
                ->get();

        return view('user.index', compact('genres', 'areas', 'blogs'));
    }

    public function category( $category )
    {
        // URLのクエリパラメータからcategory（genre）を取得し、switch構文で判別。
        // それにあわせて動的にカテゴリページを表示。
        switch($category){
            case $category === 'restaurant';
                // $services = Service::where('genre_id', 1)->with('comments')->get();
                $services = Service::where('genre_id', 1)->get();
                // ddd($services);
                return view('user.category', compact('services'));
                break;

            case $category === 'beauty';
                $services = Service::where('genre_id', 2)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'hotel';
                $services = Service::where('genre_id', 3)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'school';
                $services = Service::where('genre_id', 4)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'activity';
                $services = Service::where('genre_id', 5)->get();
                return view('user.category', compact('services'));
                break;
                
            case $category === 'shop';
                $services = Service::where('genre_id', 6)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'life';
                $services = Service::where('genre_id', 7)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'hospital';
                $services = Service::where('genre_id', 8)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'walfare';
                $services = Service::where('genre_id', 9)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'company';
                $services = Service::where('genre_id', 10)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'city';
                $services = Service::where('genre_id', 11)->get();
                return view('user.category', compact('services'));
                break;

            case $category === 'drive';
                $services = Service::where('genre_id', 12)->get();
                return view('user.category', compact('services'));
                break;
                
            case $category === 'taxi';
                $services = Service::where('genre_id', 13)->get();
                return view('user.category', compact('services'));
                break;
                
            case $category === 'reqruits';
                $services = Service::where('genre_id', 14)->get();
                return view('user.category', compact('services'));
                break;
            }
    }


    public function detail( $id )
    {
        // $detail = Service::find($id)->with('payment_service');
        $detail = Service::find($id);
        // ddd($detail);
        return view('user.detail', compact('detail'));
    }


    public function reqruit()
    {
        $reqruits = Reqruit::with('service')->get();
        // dd($reqruits);
        return view('user.reqruit', compact('reqruits'));
    }
    




    // 検索機能
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

        // dd($search_services);


        
        // ddd($services);
        return view('user.search', compact('search_services', 'services', 'genres', 'areas'));
    }
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}
