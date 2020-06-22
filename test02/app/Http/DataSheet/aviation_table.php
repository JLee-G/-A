<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class aviation_table extends Model
{
    protected $table = 'aviation_table';
    protected $fillable =   [ 
                                'Client_arr_id',
                                'Paid_status',
                                'other'
                            ];

    public function orders()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = order_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'shopping_id', 'Order_id')->withTimestamps();
    }

    public function classifications()
    {
        $pivotTable = 'order_shopping_table';

        $relatedModel = order_table::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'shopping_id', 'Type')->withTimestamps();
    }

    public function aviation_companys()
    {
        $pivotTable = 'supplier_aviation';

        $relatedModel = aviation_company::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'id', 'aviation_id')->withTimestamps()->withPivot(['aviation_id','Numbering']);
    }
    
}