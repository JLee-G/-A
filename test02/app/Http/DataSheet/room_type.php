<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class room_type extends Model
{
    protected $table = 'room_type';
    protected $fillable =   [ 
                                'name'
                            ];
}