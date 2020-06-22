<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class room_table extends Model
{
    protected $table = 'room_table';
    protected $fillable =   [              
                                'supplier_hotel_id',
                                'room_test',
                                'amount',
                                'currency',
                                'room_type'
                            ];
}