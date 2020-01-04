<?php

namespace App\Http\Middleware;

use App\Member;
use Closure;

class CheckClassMember extends PermissionBase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Member::count($this->user->id, @$request->route('class')->id)) {
            return response()->json(self::ACCESS_FORBIDDEN, 403);
        }
        return $next($request);
    }
}
