<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class currency_table extends Model
{
    protected $table = 'currency_table';
    protected $fillable =   [ 
                                'Currency_name'
                            ];
}