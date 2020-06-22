<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class hotel_shopping extends Model
{
    protected $table = 'hotel_shopping';
    protected $fillable =   [ 
                                'Store_Hotel_id',
                                'clients_id',
                                'client_id',
                                'Room_name'
                            ];


}