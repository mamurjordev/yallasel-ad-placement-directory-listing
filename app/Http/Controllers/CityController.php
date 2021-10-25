<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('City/List', [
            'cities' => DB::table('cities')->orderByDesc('updated_at')->paginate(15)
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
        return Inertia::render('City/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'city_name' => ['required', 'max:300'],
        //     'city_name_ar' => ['required', 'max:300'],
        // ]);

        City::create(
            $request->validate([
                'city_name' => ['required', 'max:300'],
                'city_name_ar' => ['required', 'max:300'],
            ])
        );

        return Redirect::route('panel.city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        Inertia::setRootView('admin');
        return Inertia::render('City/Edit', [
            'city' => City::find($city->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city->city_name = $request->city_name;
        $city->city_name_ar = $request->city_name_ar;

        $city->save();

        return Redirect::route('panel.city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return back();
    }
}
