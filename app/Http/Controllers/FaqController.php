<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Faq/List', [
            'faqs' => DB::table('faqs')->orderByDesc('updated_at')
                ->paginate(20)
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
        return Inertia::render('Faq/Create', [
            'sub_categories' => DB::table('faqs')->distinct()->select('sub_category')->orderBy('sub_category')->get(),
            'languages' => DB::table('languages')->select('id', 'language_name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'language_id' => 'required',
            'category' => 'required',
            'params' => 'required',
            'sub_category' => 'required',
            'title' => 'required',
            'details' => 'required',
            'status' => 'required',
        ]);

        $faq = new Faq();
        $faq->create([
            'language_id' => $request->language_id,
            'category' => $request->category,
            'params' => Str::slug($request->category),
            'sub_category' => $request->sub_category,
            'title' => $request->title,
            'details' => $request->details,
            'status' => $request->status,
        ]);
        return Redirect::route('panel.faq.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return Inertia::render('ShowFaq', [
            'faq' => $faq
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Faq/Edit', [
            'faq' => $faq,
            'sub_categories' => DB::table('faqs')->distinct()->select('sub_category')->orderBy('sub_category')->get(),
            'languages' => DB::table('languages')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faq->language_id = $request->language_id;
        $faq->category = $request->category;
        $faq->params = Str::slug($request->category);
        $faq->sub_category = $request->sub_category;
        $faq->title = $request->title;
        $faq->details = $request->details;
        $faq->status = $request->status;
        $faq->save();
        return Redirect::route('panel.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return Redirect::route('panel.faq.index');
    }

    public function search($search)
    {
        return Inertia::render('faqSearch', [
            'faqs' => DB::table('faqs')->where('title', 'LIKE', '%' . $search . '%')->get()
        ]);
    }
}
