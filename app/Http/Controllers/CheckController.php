<?php

namespace App\Http\Controllers;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Spatie\ImageOptimizer\OptimizerChainFactory;

class CheckController extends Controller
{
    public function index()
    {
        $datas = DB::table('post_attributes')->where('post_attribute->horsepower->value', '>=', 490)->select('post_attribute->horsepower->value')->get();
        // $data = DB::table('post_attributes')->select('post_attribute->fuel')->get();

        $ids = [];

        foreach ($datas as $key => $value) {
            dd($value);
        }
        dd((array)$ids[0]);
    }
}

// 670.3kb
