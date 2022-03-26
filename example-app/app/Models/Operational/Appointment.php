<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Appointment extends Model
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
        'doctor_id',
        'user_id',
        'consultation_id',
        'level',
        'date',
        'time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Relationship table doctor - table appointment = One to Many
    public function doctor()
        {
            return $this->belongsTo('App\Models\Operational\Doctor','doctor_id', 'id');
        }
    
    //Relationship table consultation(Ngirim) - table appointment(Nerima) = One to Many
    public function consultation()
        {
            return $this->belongsTo('App\Models\MasterData\Consultation','consultation_id', 'id');
        }

    //Relationship table user(Ngirim) - table appointment(Nerima) = One to Many
    public function user()
        {
            return $this->belongsTo('App\Models\User','user_id', 'id');
        }
    
    //Relationship table appointment(Ngirim) - table transaction(Nerima) = One to One
    public function transaction()
        {
            //relationship hasOne(path model, foreign key destination table)
            return $this->hasOne('App\Models\Operational\Doctor', 'appointment_id');
        }
}
