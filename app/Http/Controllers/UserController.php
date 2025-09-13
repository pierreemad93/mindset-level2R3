<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        //Eloquent ORM 
        //return collection
        $users = User::get();
        return view('admin.users.all', ['users' => $users]);
    }

    public function create()
    {

        return view('admin.users.create');
    }
    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return to_route('users.index');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
    }
}
