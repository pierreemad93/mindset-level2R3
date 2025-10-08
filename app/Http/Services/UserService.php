<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserService
{
    public static function index()
    {
        if (!Gate::allows('users-view')) {
            abort(403);
        }
        $users = User::select('id', 'name', 'email')->with('roles')->simplePaginate(5);
        return $users;
    }
    
}
