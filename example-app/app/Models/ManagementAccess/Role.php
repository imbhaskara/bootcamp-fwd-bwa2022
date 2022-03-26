<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Role extends Model
{
     //use HasFactory;
     use softDeletes;
    
     //Declare table
     public $table ='role';
 
     protected $dates = [
         'created_at',
         'updated_at',
         'deleted_at',
     ];
 
     protected $fillable = [
         'title',
         'created_at',
         'updated_at',
         'deleted_at',
     ];

    //Relationship table role(Ngirim) - table role user(Nerima) = One to Many
    public function role_user()
    {
        //relationship hasMany(path model, foreign key destination table)
        return $this->hasMany('App\Models\ManagementAccess\RoleUser', 'role_id');
    }

    //Relationship table role(Ngirim) - table permission role(Nerima) = One to Many
    public function permission_role()
    {
        //relationship hasMany(path model, foreign key destination table)
        return $this->hasMany('App\Models\ManagementAccess\PermissionRole', 'role_id');
    }
}
