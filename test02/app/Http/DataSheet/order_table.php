<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class order_table extends Model
{
    protected $table = 'order_table';
    protected $fillable =   [ 
                                'number',
                                'Amount'
                            ];

    public function aviations()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = aviation_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_id', 'shopping_id')->withTimestamps()->withPivot(['Type','Group_number']);
    }

    public function hotel_shoppings()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = hotel_shopping::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_id', 'shopping_id')->withTimestamps()->withPivot(['Type','id']);
    }


    public function classifications()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = order_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_id', 'Type')->withTimestamps();
    }

    public function order_shopping_tables()
    {
        $pivotTable = 'amount_group';

        $relatedModel = order_shopping_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_id', 'Group_number')->withTimestamps()->withPivot(['Amount']);
    }

}