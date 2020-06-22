<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class amount extends Model
{
    protected $table = 'amount';
    protected $fillable =   [ 
                                'amount',
                                'Currency'
                            ];

    public function order_shopping_tables()
    {
        $pivotTable = 'amount-order_shopping_table';

        $relatedModel = order_shopping_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'amount_id', 'order_shopping_table_id')->withTimestamps();
    }

}