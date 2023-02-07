<?php

namespace App\Http\Controllers\Owner;

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
use App\Models\Owner;
use App\Models\Tag;

use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }


   public function index()
   {
    $owner = Auth::user();
    return view('owner.dashboard', compact('owner'));
   }
}
