<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        Inertia::setRootView('admin');
        if ($request->year) :
            $year = $request->year;
        else :
            $year = date('Y');
        endif;
        $posts = DB::select("SELECT MONTH(created_at) month, COUNT(*) posts FROM posts WHERE YEAR(created_at) = $year GROUP BY created_at");
        $posts_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($posts as $key => $post) :
            $key = $post->month - 1;
            $posts_count[$key] += $post->posts;
        endforeach;



        return Inertia::render('Dashboard', [
            'postsCount' => $posts_count,
            'postsByCategory' => (new StatisticsController)->postsByCategory(),
            'usersByRoles' => (new StatisticsController)->usersByType(),
            'usersByCities' => (new StatisticsController)->usersByCities(),
            'usersByRegions' => (new StatisticsController)->usersByRegions()
        ]);
    }
}
