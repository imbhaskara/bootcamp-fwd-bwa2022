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

     public function permission()
     {
         return $this->belongsToMany('App\Models\ManagementAccess\Permission');
     }
 
     // one to many
     public function role_user()
     {
         // 2 parameter (path model, field foreign key)
         return $this->hasMany('App\Models\ManagementAccess\RoleUser', 'role_id');
     }
 
     public function permission_role()
     {
         // 2 parameter (path model, field foreign key)
         return $this->hasMany('App\Models\ManagementAccess\PermissionRole', 'role_id');
     }
}
