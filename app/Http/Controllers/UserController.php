<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id ,Request $request)
    {
        $user = User::findOrFail($id[0])->orWhereHas('galleries', function ($q) use ($request) {
            $q->orWhere('description', 'LIKE', '%' . $request->search . '%')->orWhere('name', 'LIKE', '%' . $request->search . '%');
        })->where('id', $id)->with('galleries')->orderBy('id', 'desc')->paginate(10);

        return $user;
    }
}
