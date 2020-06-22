<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class client_table extends Model
{
    protected $table = 'client_table';
    protected $fillable =   [ 
                                'name',
                                'gender',
                                'name_en',
                                'address',
                                'birthday',
                                'phone',
                                'Telephone_country_code',
                                'Telephone_area_code',
                                'Extension',
                                'Cell_phone',
                                'Emain'
                            ];


}