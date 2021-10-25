<?php

namespace App\Http\Controllers\admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PaymentPackage;

class StatisticsController extends Controller
{

    public function users()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Statistics/Users', [
            'usersByRoles' => $this->usersByType(),
            'usersByCities' => $this->usersByCities(),
            'usersByRegions' => $this->usersByRegions()
        ]);
    }

    public function ads(Request $request)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Statistics/Ads', [
            'postsCount' => $this->postsByMonths($request),
            'postsByCategory' => $this->postsByCategory(),
        ]);
    }

    public function package(Request $request)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Statistics/Package', [
            'packageSold' => $this->packageSoldByMonths($request),
            'packageDetails' => $this->packageSoldDetails()
        ]);
    }

    public function packageSoldDetails()
    {
        // DB::table('package_logs as pl')->join('payment_packages as pp', 'pp.id', 'pl.package_id')
        //     ->select('pl.*', 'pp.name', 'pp.is_subscription', 'pp.time_period', 'pp.subscription_length', 'pp.post_amount', DB::raw())
        //     ->paginate(50);
        return PaymentPackage::with('sold')->paginate(10);
    }

    public function packageSoldByMonths(Request $request)
    {
        if ($request->year) :
            $year = $request->year;
        else :
            $year = date('Y');
        endif;
        $posts = DB::select("SELECT MONTH(created_at) month, COUNT(*) posts FROM package_logs WHERE YEAR(created_at) = $year GROUP BY created_at");
        $posts_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($posts as $key => $post) :
            $key = $post->month - 1;
            $posts_count[$key] += $post->posts;
        endforeach;
        return $posts_count;
    }
    public function postsByMonths(Request $request)
    {
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
        return $posts_count;
    }

    public function postsByCategory()
    {
        $datas = DB::table('categories')
            ->select('category_name', 'items_count')
            ->where('items_count', '>', 0)
            ->get();
        $category = [];
        $items_count = [];
        foreach ($datas as $data) {
            array_push($category, $data->category_name);
            array_push($items_count, $data->items_count);
        }
        return $data = [
            'titles' => $category,
            'counts' => $items_count
        ];
    }

    public function usersByType()
    {
        $datas = DB::table('users')->select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();
        $titles = [];
        $counts = [];

        foreach ($datas as $data) {
            array_push($titles, $data->role);
            array_push($counts, $data->count);
        }

        return $data = [
            'titles' => $titles,
            'counts' => $counts
        ];
    }

    public function usersByCities()
    {
        $datas = DB::table('cities')->join('account_settings as acs', 'cities.id', 'acs.city_id')
            ->select('cities.city_name', DB::raw('count(*) as users'))
            ->groupBy('cities.city_name')
            ->get();
        $infos  = [];
        foreach ($datas as $data) {
            $info = [
                'x' => $data->city_name,
                'y' => $data->users
            ];
            array_push($infos, $info);
        }
        return $infos;
    }

    public function usersByRegions()
    {
        $datas = DB::table('regions')->join('account_settings as acs', 'regions.id', 'acs.region_id')
            ->select('regions.region_name', DB::raw('count(*) as users'))
            ->groupBy('regions.region_name')
            ->get();
        $infos  = [];
        foreach ($datas as $data) {
            $info = [
                'x' => $data->region_name,
                'y' => $data->users
            ];
            array_push($infos, $info);
        }
        return $infos;
    }
}
