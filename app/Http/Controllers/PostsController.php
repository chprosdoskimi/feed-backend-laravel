<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), []);
    }

    public function index()
    {
        try {
            $post = DB::select('select * from posts');

            return response()->json($post);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
