<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function editTerms()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Terms/Form', [
            'page' => DB::table('pages')->where('slug', 'terms-of-use')->first()
        ]);
    }
    public function updateTerms(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        DB::table('pages')->where('slug', 'terms-of-use')->update(['content' => $request->content]);

        return back()->with('success', 'Page updated successfully');
    }
}
