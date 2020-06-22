<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table = 'client';
    protected $fillable =   [ 
                                'name',
                                'name_en',
                                'gender',
                                'address',
                                'birthday',
                                'phone',
                                'Telephone_country_code',
                                'Telephone_area_code',
                                'Extension',
                                'Cell_phone',
                                'Emain',
                            ];
}