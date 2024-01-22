<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderByDesc('published_at')->paginate(3);
        return response()->json(['posts' => $posts]);
    }
}
