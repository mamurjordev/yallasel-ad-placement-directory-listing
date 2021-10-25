<?php

namespace App\Http\Controllers;

use App\Models\Widget;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Widgets/Widgets');
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
        Widget::updateOrCreate(
            ['place' => $request->place],
            ['widget' => $request->widget]
        );

        // $a = array_keys($request->files->all());
        // dd($a);

        // $images = [];
        // $keys = array_keys($request->files->all());
        // foreach ($keys as $key) {
        //     array_push($images, $key);
        // }
        // dd($images);

        // $i = 0;
        if ($request->files) {
            foreach ($request->files as $key => $image) {
                $imageName = $key . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('media/widget'), $imageName);
            }
        }

        // $widget->save();
        return back()->with('success', 'Widget updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        //
    }
}
