<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Article/List', [
            'articles' => Article::orderBy('id', 'DESC')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Inertia::setRootView('admin');
        $languages = DB::table('languages')->get();
        return Inertia::render('Article/Create')->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => ['required', 'max:300'],
            'text' => ['required'],
            'Status' => ['required'],
            'Image' => ['required'],
            'language' => ['required']
        ]);


        // dd($request);

        $article = new Article();
        $article->user_id = Auth::user()->id;
        $article->language = $request->language;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->status = $request->Status;

        $imageName = time() . '.' . $request->Image->getClientOriginalExtension();
        $article->image = $imageName;
        $request->file('Image')->move(public_path('media/articles'), $imageName);

        $article->save();

        return Redirect::route('panel.article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return Inertia::render('ArticleView', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Article/Edit', [
            'article' => Article::find($article->id),
            'languages' => DB::table('languages')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $article->user_id = Auth::user()->id;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->status = $request->Status;


        if ($request->Image) {
            $imageName = time() . '.' . $request->Image->getClientOriginalExtension();
            $article->image = $imageName;
            $request->file('Image')->move(public_path('media/articles'), $imageName);
        }

        $article->save();

        return Redirect::route('panel.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return Redirect::route('panel.article.index');
    }
}
