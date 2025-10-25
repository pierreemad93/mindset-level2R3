<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use App\Notifications\NewUserNotification;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = UserService::index();
        return view('admin.users.all', ['users' => $users]);
    }

    public function create()
    {

        $roles = Role::select('id',  'name')->get();
        // $roles = Role::pluck('name', 'id')->toArray();
        // dd($roles);
        return view('admin.users.create', ['roles' => $roles]);
    }
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $user->assignRole($data['role']);
        return to_route('users.index');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
    }
}
