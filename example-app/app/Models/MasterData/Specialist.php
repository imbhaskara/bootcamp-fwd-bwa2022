<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    //use HasFactory;
    use SoftDeletes;
    
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

    public function doctor()
    {
        //relationship hasMany(path model, foreign key destination table)
        return $this->hasMany('App\Models\Operational\Doctor', 'specialist_id');
    }
}
