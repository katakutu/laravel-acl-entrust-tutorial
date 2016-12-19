<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
    	$data = \App\User::orderBy('id', 'DESC')->paginate(5);
    	return view('users.index', compact('data'))
    		->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
