<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;


class UsersController extends Controller
{

    public function index()
    {
        $users = Users::select(
            'users.id AS Id_user', 
            'users.name', 
            'users.surname', 
            'users.email', 
            'users.password',
            'users.status', 
            'users.created_at', 
            'users.updated_at', 
            'users.fk_role',
            'roles.role'
            )
        ->join('roles', 'users.fk_role', '=', 'roles.id')
        ->where('users.fk_role', '!=', 1)
        ->get();

        return $users;
    }
    public function read()
    {
        $users = Users::select(
            'users.id AS Id_user', 
            'users.name', 
            'users.surname', 
            'users.email', 
            'users.password',
            'users.status', 
            'users.created_at', 
            'users.updated_at', 
            'users.fk_role',
            'roles.role'
            )
        ->join('roles', 'users.fk_role', '=', 'roles.id')
        ->get();

        return $users;
    }

    public function store(Request $request)
    {
        $user = new Users();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->fk_role = $request->fk_role;

        $user->save();
    }

    public function show($id)
    {
        $user = Users::select('users.id', 'users.name', 'users.surname', 'users.email', 'users.password', 'users.status', 'users.created_at', 'users.updated_at', 'users.fk_role','roles.role')
        ->join('roles', 'users.fk_role', '=', 'roles.id')
        ->where('users.id', $id)
        ->first();
        return $user;
    }

    
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->fk_role = $request->fk_role;

        $user->save();
        return $user;
    }

}
