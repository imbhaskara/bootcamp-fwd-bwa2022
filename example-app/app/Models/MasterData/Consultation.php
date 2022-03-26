<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Consultation extends Model
{
    //use HasFactory;
    use softDeletes;
    
    //Declare table
    public $table ='consultation';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function appointment()
        {
            //relationship hasMany(path model, foreign key destination table)
            return $this->hasMany('App\Models\Operational\Appointment', 'consultation_id');
        }
}
