<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Dashboard',
            'data' => [
                'total_articles' => Article::count(),
                'total_users' => User::count()
            ]
        ]);
    }
}
