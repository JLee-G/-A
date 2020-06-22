<?php

namespace App\Http\Controllers\DataSheet;
        
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $table = 'user_department';	//連接到users資料表
    protected $fillable = ['name'];	        //可以更動欄位
}