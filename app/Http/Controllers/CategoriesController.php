<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoriesController extends Controller
{
    public function index()
    {
        try {
            $category = DB::select('select * from categories');

            return response()->json($category);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy()
    {
    }
}
