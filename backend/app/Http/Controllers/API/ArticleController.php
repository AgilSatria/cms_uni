<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    // List dengan search
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'List',
            'data' => $articles
        ]);
    }

    // Detail berdasarkan slug
    public function show($slug)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail',
            'data' => Article::where('slug', $slug)->first()
        ]);
    }


    // Detail berdasarkan id
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $data = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'author_id' => Auth::id()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil tambah',
            'data' => $data
        ]);
    }

    // Update berdasarkan id
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil update',
            'data' => $article
        ]);
    }


    public function showById($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail',
            'data' => Article::find($id)
        ]);
    }



    // Hapus berdasarkan id
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
