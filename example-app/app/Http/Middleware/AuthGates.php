<?php

namespace App\Http\Middleware;

use Closure; // Closure gunanya untuk mengambil all request data dari aplikasi
use Illuminate\Http\Request; // Mengambil all request dari tampilan ke backend

// Import model yang kita gunakan dalam middleware
use App\Models\ManagementAccess\Role;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kita ambil semua user yang login pada session tersebut
        $user = \Auth::user();

        // Checking validation in middleware
        // Check system on or not

        if(!app()->runningInConsole() && $user)
        {
            $roles              = Role::with('permission')->get();
            $permissionsArray   = [];

            // Nested loop
            // looping for role (dari table user)
            foreach($roles as $role){
                // looping for permission (dari table permission role)
                foreach($role->permission as $permissions)
                {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }
            
            // Check User Role
            foreach($permissionsArray as $title => $roles)
            {
                Gate::define($title, function(\App\Models\User $user)
                use($roles){
                    return count(array_intersect($user->role->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        // return all middleware
        return $next($request);
    }
}
