<?php

namespace App\Http\Controllers\DataSheet;

use Illuminate\Database\Eloquent\Model;

class routes extends Model
{
    protected $table = 'allow_routes';
    protected $fillable =   [ 
                                'id',
                                'routes',
                                'Competence',
                                'created_at',
                                'updated_at'
                            ];

    
}