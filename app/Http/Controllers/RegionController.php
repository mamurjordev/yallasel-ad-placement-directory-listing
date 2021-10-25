<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Region/List', [
            'regions' => DB::table('regions')->orderByDesc('updated_at')->paginate(15)
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
        return Inertia::render('Region/Create', [
            'cities' => DB::table('cities')->orderBy('city_name')->get(['id', 'city_name'])
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
        Region::create(
            $request->validate([
                'region_name' => ['required', 'max:300'],
                'region_name_ar' => ['required', 'max:300'],
                'city_id' => ['required'],
            ])
        );
        return Redirect::route('panel.region.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Region/Edit', [
            'region' => Region::find($region->id),
            'cities' => DB::table('cities')->orderBy('city_name')->get(['id', 'city_name']),
            'city_id' => ['required'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->region_name = $request->region_name;
        $region->region_name_ar = $request->region_name_ar;
        $region->city_id = $request->city_id;

        $region->save();

        return Redirect::route('panel.region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return back();
    }
}
