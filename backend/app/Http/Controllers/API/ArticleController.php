<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\User;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List',
            'data' => Article::latest()->paginate(10)
        ]);
    }


    public function show($slug)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail',
            'data' => Article::where('slug', $slug)->first()
        ]);
    }


    public function store(Request $request)
    {
        $data = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'author_id' => auth()->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil tambah',
            'data' => $data
        ]);
    }


    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Berhasil update',
            'data' => $article
        ]);
    }




    public function destroy($id)
    {
        Article::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil hapus',
            'data' => null
        ]);
    }
}
