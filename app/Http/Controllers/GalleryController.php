<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $galleries = Gallery::orWhereHas('user', function ($q) use ($request) {
            $q->where('first_name', 'LIKE', '%' . $request->search . '%');
        })->orWhere('name', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->with('user')->orderBy('id', 'desc')->paginate(10);

        return $galleries;
    }

    public function show($id)
    {
        return Gallery::with('user')->with('comments')->findOrFail($id);
    }

    public function store(GalleryRequest $request)
    {
        if (!$request->input('description')) {
            $request->merge(['description' => '']);
        }
        $gallery = $request->all();
        $gallery['user_id'] = Auth::user()->id;
        return Gallery::create($gallery);
    }

    public function update($id, GalleryRequest $request)
    {
        if (!$request->input('description')) {
            $request->merge(['description' => '']);
        }
        return Gallery::findOrFail($id)->update($request->all());
    }

    public function destroy($id)
    {
        return Gallery::destroy($id);
    }
}
