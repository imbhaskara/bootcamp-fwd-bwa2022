<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Specialist extends Model
{
    //use HasFactory;
    use softDeletes;
    
    //Declare table
    public $table ='specialist';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'updated_at',
        'deleted_at',
    ];
}
