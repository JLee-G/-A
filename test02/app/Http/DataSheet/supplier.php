<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable =   [ 
                                'name',
                                'phone',
                                'address'
                            ];

    public function hotel_companys()
    {
        $pivotTable = 'supplier_hotel';

        $relatedModel = hotel_company::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'supplier_id', 'hotel_id')->withTimestamps();
    }
}