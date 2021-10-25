<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FilterController extends Controller
{
    public function index()
    {
        return Inertia::render('Filters');
    }
}
