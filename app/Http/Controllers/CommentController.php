<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store($id, CommentRequest $request){
        $comment = $request->only(['body']);
        $comment['user_id'] = Auth::user()->id;
        $comment['gallery_id'] = (int) $id;
        return Comment::create($comment);
    }

    public function destroy($id){
        return Comment::destroy($id);
    }

}
