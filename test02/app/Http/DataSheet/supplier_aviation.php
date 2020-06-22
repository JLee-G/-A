<?php

namespace App\Http\DataSheet;

use Illuminate\Database\Eloquent\Model;

class supplier_aviation extends Model
{
    protected $table = 'supplier_aviation';
    protected $fillable =   [ 
                                'aviation_id',
                                'supplier_id',
                                'Numbering'
                            ];

}