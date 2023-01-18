<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_name',
    ];


        // 事業との多対多
    public function services()
    {
        return $this->belognsToMany('App\services');
    }


}
