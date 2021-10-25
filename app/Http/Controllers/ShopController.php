<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function openShop()
    {
        return Inertia::render('Shop/OpenShop', [
            'categories' => DB::table('categories')->select('id', 'category_name')->orderBy('category_name')->get()
        ]);
    }
}
