<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
public function index(){
    return view("users.index");
}


public function getData()
{
    return DataTables::of(User::query())->make(true);
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return response()->json(['message' => 'User added successfully!']);
}

}
