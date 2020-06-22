<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class classification extends Model
{
    protected $table = 'classification';
    protected $fillable =   [ 
                                'id',
                                'class_name'
                            ];

    public function orders()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = order_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'Order_id', 'Type')->withTimestamps();
    }

    public function shoppings()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = order_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'shopping_id', 'Type')->withTimestamps();
    }
}