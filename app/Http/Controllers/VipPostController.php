<?php

namespace App\Http\Controllers;

use App\Models\VipPost;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VipPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('VipPost/List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VipPost  $vipPost
     * @return \Illuminate\Http\Response
     */
    public function show(VipPost $vipPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VipPost  $vipPost
     * @return \Illuminate\Http\Response
     */
    public function edit(VipPost $vipPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VipPost  $vipPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VipPost $vipPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VipPost  $vipPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(VipPost $vipPost)
    {
        //
    }
}
