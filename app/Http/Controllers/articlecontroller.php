<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:view articles')->only('index');
    $this->middleware('permission:create articles')->only(['create', 'store']);
    $this->middleware('permission:edit articles')->only(['edit', 'update']);
    $this->middleware('permission:delete articles')->only('destroy');
}



    public function index()
    {
        $articles = Article::latest()->paginate(25);
        return view('articles.list', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|min:3',
    //         'author' => 'required|min:3',
    //     ]);

    //     if ($validator->passes()) {
    //         $article = new Article();
    //         $article->title = $request->title;
    //         $article->text = $request->text;
    //         $article->author = $request->author;
    //         $article->save();

    //         return redirect()->route('articles.index')->with('success', 'Article added successfully');
    //     } else {
    //         return redirect()->route('articles.create')->withInput()->withErrors($validator);
    //     }
    // }




   public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'text' => 'required|string',
        'author' => 'required|string|max:255',
    ]);

    Article::create([
        'title' => $request->title,
        'text' => $request->text,
        'author' => $request->author,
    ]);

    return redirect()->route('articles.index')->with('success', 'Article created!');
}



    // public function show(string $id)
    // {
    //     //
    // }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    // public function update(Request $request, string $id)
    // {
    //     $article = Article::findOrFail($id);
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|min:3',
    //         'author' => 'required|min:3',
    //     ]);

    //     if ($validator->passes()) {
    //         $article->title = $request->title;
    //         $article->text = $request->text;
    //         $article->author = $request->author;
    //         $article->save();

    //         return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    //     } else {
    //         return redirect()->route('articles.edit', $id)->withInput()->withErrors($validator);
    //     }
    // }

    // public function destroy(string $id)
    // {
    //     $article = Article::find($id);
    //     if (!$article) {
    //         session()->flash('error', 'Article not found');
    //         return response()->json(['status' => false]);
    //     }

    //     $article->delete();
    //     session()->flash('success', 'Article deleted successfully.');
    //     return response()->json(['status' => true]);
    // }

    public function update(Request $request, string $id)
{
    $article = Article::findOrFail($id);
    $validator = Validator::make($request->all(), [
        'title' => 'required|min:3',
        'author' => 'required|min:3',
    ]);

    if ($validator->passes()) {
        $article->title = $request->title;
        $article->text = $request->text;
        $article->author = $request->author;
        $article->save();

        // ✅ Proper redirect with success message
        return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    } else {
        return redirect()->route('articles.edit', $id)->withInput()->withErrors($validator);
    }
}


    public function destroy(string $id)
{
    $article = Article::find($id);
    if (!$article) {
        return response()->json(['status' => false]);
    }

    $article->delete();
    return response()->json(['status' => true]);
}

}
