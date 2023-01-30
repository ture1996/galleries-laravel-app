<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        return Gallery::all();
    }

    public function show($id)
    {
        return Gallery::findOrFail($id);
    }

    public function store(GalleryRequest $request)
    {
        $user = $request->all();
        $user['user_id'] = Auth::user()->id;
        return Gallery::create($user);
    }

    public function update($id, GalleryRequest $request)
    {
        return Gallery::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        return Gallery::destroy($id);
    }
}
