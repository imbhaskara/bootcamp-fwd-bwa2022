<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class DetailUser extends Model
{
    //use HasFactory;
    use softDeletes;
    
    //Declare table
    public $table ='detail_user';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'type_user_id',
        'contact',
        'address',
        'photo',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    public function type_user()
    {
        //relationship hasMany belongsTo(path model, foreign key, primary key from origin table)
        return $this->belongsTo('App\Models\MasterData\TypeUser', 'type_user_id', 'id');
    }

    //Relationship table user(Ngirim) - table detailUser(Nerima) = One to One
    public function user()
        {
            return $this->belongsTo('App\Models\User','user_id', 'id');
        }
}
