<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, SoftDeletes;//, LogsActivity;

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults();
    // }

    protected static $logName = 'role';
    static $logFillable = true;
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id')
        ->using(RolePermission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->attach($permission->id);
    }

    public function givePermissionToById($permission_id)
    {
        return $this->permissions()->attach($permission_id);
    }

    public function givePermissionsToByIds($permissions_ids)
    {
        foreach($permissions_ids as $permission_id)
        $this->permissions()->attach($permission_id);
        return true;
    }

    public function romvePermissionTo(Permission $permission)
    {
        return $this->permissions()->detach($permission->id);
    }

    public function romvePermissionToById($permission_id)
    {
        return $this->permissions()->detach($permission_id);
    }

    public function romvePermissionsToByIds($permissions_ids)
    {
        foreach($permissions_ids as $permission_id)
        $this->permissions()->detach($permission_id);
        return true;
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(Permission $permission)
    {
      if (!isset($permission)) return false;
          return $this->permissions->contains('name', $permission->name);
    }

    public function hasPermissionByName($permission_name)
    {
      if (!isset($permission_name)) return false;
          return $this->permissions->contains('name', $permission_name);
    }

    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */
    public function inRole($permission)
    {
      if (is_string($permission)) {
          return $this->permissions->contains('name', $permission);
      }
      return !! $permission->intersect($this->permissions)->count();
    }
}
