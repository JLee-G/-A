<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class hotel_company extends Model
{
    protected $table = 'hotel_company';
    protected $fillable =   [ 
                                'name',
                                'phone',
                                'address'
                            ];

}