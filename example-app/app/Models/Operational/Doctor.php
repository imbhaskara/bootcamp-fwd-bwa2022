<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Doctor extends Model
{
        //use HasFactory;
        use softDeletes;
    
        //Declare table
        public $table ='appointment';
    
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    
        protected $fillable = [
            'specialist_id',
            'name',
            'fee',
            'photo',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        public function specialist()
        {
            return $this->belongsTo('App\Models\MasterData\Specialist','specialist_id', 'id');
        }

        public function appointment()
        {
            //relationship hasMany(path model, foreign key destination table)
            return $this->hasMany('App\Models\Operational\Appointment', 'doctor_id');
        }
}