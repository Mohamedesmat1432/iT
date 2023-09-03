<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = '';
        if (auth()->user()->role === 'admin') {
            $home = '/admin/dashboard';
        } elseif (auth()->user()->role === 'support') {
            $home = '/support/dashboard';
        } else {
            $home = '/user/dashboard';
        }

        return redirect()->intended($home);
    }
}
