<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class aviation_company extends Model
{
    protected $table = 'aviation_company';
    protected $fillable =   [ 
                                'name',
                                'phone',
                                'address'
                            ];

    public function aviation_tables()
    {
        $pivotTable = 'supplier_aviation';

        $relatedModel = aviation_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'id', 'aviation_id')->withTimestamps();
    }

}