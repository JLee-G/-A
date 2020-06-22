<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class clients_table extends Model
{
    protected $table = 'clients_table';
    protected $fillable =   [ 
                                'name',
                                'gender',
                                'Amount'
                            ];

    public function order_shopping_tables()
    {
        $pivotTable = 'amount_individual';

        $relatedModel = order_shopping_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_shopping_id', 'Client_id')->withTimestamps()->withPivot(['Amount']);
    }
}