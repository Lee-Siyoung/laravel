<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Board;

class PostController extends Controller
{
    public function index($boardId)
    {
        try {
            $board = Board::find($boardId);
            $posts = $board->posts;
            return response()->json($posts, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request, $boardId)
    {
        try {
            $board = Board::find($boardId);
            $post = new Post();
            $post->name = $request['name'];
            $post->detail = $request['detail'];
            $board->posts()->save($post);
            return response()->json($post, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show($boardId, $postId)
    {
        try {
            $board = Board::find($boardId);
            $post = $board->posts()->find($postId);
            return response()->json($post, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $boardId, $postId)
    {
        try {
            $board = Board::find($boardId);
            $post = $board->posts()->find($postId);
            $post->name = $request['name'];
            $post->detail = $request['detail'];
            $post->save();
            return response()->json($post, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function destroy($boardId, $postId)
    {
        try {
            $board = Board::find($boardId);
            $post = $board->posts()->find($postId);

            $post->delete();
            return response()->json(["deleted" => true], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}