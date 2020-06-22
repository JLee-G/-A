<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class supplier_hotel extends Model
{
    protected $table = 'supplier_hotel';
    protected $fillable =   [                       
                                'hotel_id',
                                'supplier_id',
                                'Numbering'
                            ];
}