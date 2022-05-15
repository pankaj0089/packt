<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Post;
use Auth;

class ApiController extends Controller
{
    public function getAuthors()
    {
        $authors = Author::with('posts')->orderBy('name', 'ASC')->get();
        return response()->json([
           'data' => $authors,
        ]);
    }

    public function getPosts()
    {
        $authors = Post::with('author')->orderBy('title', 'ASC')->get();
        return response()->json([
           'data' => $authors,
        ]);
    }

    public function getAuthorById(Request $request) {
      $author = Author::with('posts')->find($request->get('id'));
      return response()->json([
         'data' => $author,
      ]);
    }

    public function getPostById(Request $request) {
      $author = Post::with('author')->find($request->get('id'));
      return response()->json([
         'data' => $author,
      ]);
    }
}
