<?php

namespace App\Models\ManagementAccess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
     //use HasFactory;
     use SoftDeletes;
    
     //Declare table
     public $table ='permission';
 
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
     //Relationship table permission(Ngirim) - table Role (Nerima) = Many to Many
     public function Role()
     {
         return $this->belongsToMany('App\Models\ManagementAccess\Role');
     }

     //Relationship table permission(Ngirim) - table permission role(Nerima) = One to Many
    public function permission_role()
    {
        //relationship hasMany(path model, foreign key destination table)
        return $this->hasMany('App\Models\ManagementAccess\PermissionRole', 'permission_id');
    }
}
