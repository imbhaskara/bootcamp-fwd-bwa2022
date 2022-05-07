<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
       //use HasFactory;
       use SoftDeletes;
    
       //Declare table
       public $table ='role_user';
   
       protected $dates = [
           'created_at',
           'updated_at',
           'deleted_at',
       ];
   
       protected $fillable = [
           'role_id',
           'user_id',
           'created_at',
           'updated_at',
           'deleted_at',
       ];

    //Relationship table user(Ngirim) - table roleUser(Nerima) = One to Many
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    //Relationship table role(Ngirim) - table roleUser(Nerima) = One to Many
    public function role()
    {
        return $this->belongsTo('App\Models\ManagementAccess\Role','role_id', 'id');
    }
}
