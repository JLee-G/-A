<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class order_shopping_table extends Model
{
    protected $table = 'order_shopping_table';
    protected $fillable =   [ 
                                'Order_id',
                                'shopping_id',
                                'Type',
                                'Discount_arr_id',
                                'Group_number',
                                'created_at',
                                'updated_at'
                            ];

    // public function clients_tables()
    // {
    //     $pivotTable = 'amount_individual';

    //     $relatedModel = clients_table::class;

    //     return $this->belongsToMany($relatedModel, $pivotTable, 'Order_shopping_id', 'Client_id')->withTimestamps()->withPivot(['Amount']);
    // }

    public function amounts()
    {
        $pivotTable = 'amount-order_shopping_table';

        $relatedModel = amount::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'order_shopping_table_id', 'amount_id')->withTimestamps()->withPivot(['Type']);
    }
}