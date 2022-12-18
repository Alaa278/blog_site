<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
       
        if (Auth::user()->role_name == 'admin') {
            $posts = Post::orderBy('updated_at', 'desc')->get();
        } else {
            $posts = Post::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        }
        return  PostResource::collection($posts)  ;       

    }
}
