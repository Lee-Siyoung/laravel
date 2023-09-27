<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function index()
    {
        try {
            $board = Board::with('posts')->get();
            return response()->json($board, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $data['name'] = $request['name'];
            $board = Board::create($data);
            return response()->json($board, 201); 
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $board = Board::with('posts')->find($id);
            if (!$board) {
                return response()->json(['error' => '게시판을 찾을 수 없습니다.'], 404); 
            }
            return response()->json($board, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $board = Board::find($id);
            if (!$board) {
                return response()->json(['error' => '게시판을 찾을 수 없습니다.'], 404);
            }

            $board->name = $request['name'];
            $board->save();
            
            return response()->json($board, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $board = Board::find($id);
            if (!$board) {
                return response()->json(['error' => '게시판을 찾을 수 없습니다.'], 404);
            }

            $board->delete();

            return response()->json(["deleted" => true], 204); // 204 No Content 상태 코드
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}