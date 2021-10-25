<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use App\Traits\RegexRange;
use Illuminate\Http\Request;
use App\Models\PostAttribute;
use App\Models\CategoryProperty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    use RegexRange;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Category/list', [
            'categories' => DB::table('categories as a')
                ->leftJoin('categories as b', 'a.parent_category', '=', 'b.id')
                ->orderBy('a.id', 'DESC')
                ->select('a.*', 'b.category_name as parent_category_name')
                ->paginate(10),
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
        return Inertia::render('Category/create', [
            'categories' => Category::all()->map(function ($category) {
                return [
                    'id' => $category->id,
                    'category_name' => $category->category_name,
                    'parent_category' => $category->parent_category,
                    'edit_url' => URL::route('panel.category.edit', $category),
                ];
            }),
            'create_url' => URL::route('panel.category.create'),
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
        if ($request->parentCategory == 'null') $request->parentCategory = null;
        $request->validate([
            'CategoryName' => 'required',
            'CategoryNameAr' => 'required',
            'Status' => 'required',
            'post_max_images_allow' => 'required',
            'post_validity_interval' => 'required',
            'Image' => 'required|image',
        ]);

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->CategoryName;
        $category->category_name_ar = $request->CategoryNameAr;
        $category->parent_category = $request->parentCategory;
        $category->status = $request->Status;
        $category->items_count = 0;
        $category->user_id = 1;
        $category->note = $request->Note;
        $category->post_max_images_allow = $request->post_max_images_allow;
        $category->post_validity_interval = $request->post_validity_interval;

        $imageName = time() . '.' . $request->Image->getClientOriginalExtension();
        $category->image = $imageName;
        $request->file('Image')->move(public_path('/media/categories'), $imageName);

        $category->save();


        $properties = json_decode($request->properties);
        foreach ($properties as $property) :
            $property_icon = $property->property_icon;
            $property_name = $property->property_name;
            $property_unit = $property->property_unit;

            $category_property = new CategoryProperty();
            $category_property->category_id = $category->id;
            $category_property->property_icon = $property_icon;
            $category_property->property_name = $property_name;
            $category_property->property_unit = $property_unit;
            $category_property->is_mandatory = 1;
            $category_property->possible_values = json_encode($property->property_values);

            $category_property->save();
        endforeach;

        return Redirect::route('panel.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $id = '', Request $request)
    {
        $reason = "for-sale";
        $sortBy = 'posts.created_at';
        $sort = 'DESC';
        DB::enableQueryLog();
        $filters = (object) [
            'min_price' => $request->min_price ?? '',
            'max_price' => $request->max_price ?? '',
            'my_from' => $request->my_from ?? '',
            'my_to' => $request->my_to ?? '',
            'mileage_from' => $request->mileage_from ?? '',
            'mileage_to' => $request->mileage_to ?? '',
            'fuel' => $request->fuel ?? '',
            'gearbox' => $request->gearbox ?? '',
            'hp_from' => $request->hp_from ?? '',
            'hp_to' => $request->hp_to ?? '',
            'color' => $request->color ? explode(',', $request->color) : [],
            'car_type' => $request->car_type ? explode(',', $request->car_type) : []
        ];

        $postIds = 'ok';

        if (
            !empty($request->my_from) ||
            !empty($request->my_to) ||
            !empty($request->mileage_from) ||
            !empty($request->mileage_to) ||
            !empty($request->fuel) ||
            !empty($request->gearbox) ||
            !empty($request->hp_from) ||
            !empty($request->hp_to) ||
            !empty($request->color) ||
            !empty($request->car_type)
        ) {

            $postIds = DB::table('post_attributes');
            if ($request->my_from) $postIds = $postIds->where('post_attribute->model year->value', '>=', (int) $request->my_from);
            if ($request->my_to) $postIds = $postIds->where('post_attribute->model year->value', '<=', (int) $request->my_to);

            if ($request->mileage_from) $postIds = $postIds->where('post_attribute->mileage->value', '>=', (int) $request->mileage_from);
            if ($request->mileage_to) $postIds = $postIds->where('post_attribute->mileage->value', '<=', (int) $request->mileage_to);

            if ($request->hp_from) $postIds = $postIds->where('post_attribute->horsepower->value', '>=', (int) $request->hp_from);
            if ($request->hp_to) $postIds = $postIds->where('post_attribute->horsepower->value', '<=', (int) $request->hp_to);

            if ($filters->fuel) $postIds = $postIds->Where('post_attribute->fuel', 'LIKE', '%' . $filters->fuel . '%');
            if ($filters->gearbox) $postIds = $postIds->Where('post_attribute->gearbox', 'LIKE', '%' . $filters->gearbox . '%');
            if ($request->color) $postIds = $postIds->where('post_attribute->color', 'regexp',  implode('|', $filters->color));
            if ($request->car_type) $postIds = $postIds->where('post_attribute->car type', 'regexp', '\\b(' . implode('|', $filters->car_type) . ')\\b');

            $postIds = $postIds->pluck('post_id')->toArray();
        }

        // $region = isset($request->r) ? $request->r : '';
        // $search = isset($request->q) ? $request->q : '';
        $sorted = isset($request->s) ? $request->s : 'l';

        if (isset($request->s)) :
            if ($request->s == 'o') :
                $sortBy = 'posts.created_at';
                $sort = 'ASC';
            elseif ($request->s == 'c') :
                $sortBy = 'posts.expected_price';
                $sort = 'ASC';
            elseif ($request->s == 'm') :
                $sortBy = 'posts.expected_price';
                $sort = 'DESC';
            endif;
        endif;

        if (isset($request->at)) :
            $reason = $request->at;
        endif;
        $regions = explode(',', $request->r);

        $posts = DB::table('posts');
        $posts = $posts->where('reason', $reason);
        if ($postIds != 'ok') $posts = $posts->whereIn('posts.id',  $postIds);
        if ($request->q) $posts = $posts->where('title', 'LIKE', "%{$request->q}%");
        if ($request->r) $posts = $posts->whereIn('region_id', $regions);
        if ($request->f) $posts = $posts->where('is_individual',  $request->f == 'b' ? false : true);
        if ($request->min_price) $posts = $posts->where('expected_price', '>=', (int) $request->min_price);
        if ($request->max_price) $posts = $posts->where('expected_price', '<=', (int) $request->max_price);
        if ($id != '') $posts = $posts->where('category_id', $id);
        $posts = $posts->orderBy($sortBy, $sort)
            ->join('regions', 'posts.region_id', '=', 'regions.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('post_attributes', 'post_attributes.id', '=', 'posts.id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'regions.region_name_ar', 'post_images.image', 'categories.category_name', 'categories.category_name_ar', 'post_attributes.post_attribute')
            ->paginate(10);

        // $boostedPosts = DB::table('posts');
        $boostedPosts = Post::whereDate('boost_until', '>', Carbon::now());
        $boostedPosts = $boostedPosts->where('reason', $reason);
        // if ($postIds) $boostedPosts = $boostedPosts->whereIn('posts.id',  $postIds);
        if ($request->q) $boostedPosts = $boostedPosts->where('title', 'LIKE', "%{$request->q}%");
        if ($request->r) $boostedPosts = $boostedPosts->whereIn('region_id', [$request->r]);
        if ($request->f) $boostedPosts = $boostedPosts->where('is_individual',  $request->f == 'b' ? false : true);
        if ($request->min_price) $boostedPosts = $boostedPosts->where('expected_price', '>=', (int) $request->min_price);
        if ($request->max_price) $boostedPosts = $boostedPosts->where('expected_price', '<=', (int) $request->max_price);
        if ($id != '') $boostedPosts = $boostedPosts->where('category_id', $id);
        $boostedPosts = $boostedPosts->whereBetween('expected_price', [(int) $request->min_price ?? 0, $request->max_price ?? 9999999999999999999999999]);
        $boostedPosts = $boostedPosts->orderBy($sortBy, $sort)
            ->join('regions', 'posts.region_id', '=', 'regions.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('post_attributes', 'post_attributes.id', '=', 'posts.id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'regions.region_name_ar', 'post_images.image', 'categories.category_name', 'categories.category_name_ar', 'post_attributes.post_attribute')
            ->inRandomOrder()->get();

        return Inertia::render('Ads', [
            'categories' => DB::table('categories')
                ->where('id', $id)
                ->orWhere('parent_category', $id)
                ->orderBy('id', 'DESC')
                ->select('id', 'category_name', 'category_name_ar', 'items_count')
                ->get(),
            'regions' => DB::table('regions')->orderBy('region_name')->select('id', 'region_name', 'region_name_ar')->get(),
            'widgets' => DB::table('widgets')->where('place', 'category')->get()
        ])
            ->with('posts', $posts)
            ->with('vipPosts', $boostedPosts)
            ->with('category', DB::table('categories')->where('id', $id)->first())
            ->with('isIndividual', $request->f)
            ->with('reason', $reason)
            ->with('sorted', $sorted)
            ->with('search', $request->q ?? '')
            ->with('regionsSelect', $request->r)
            ->with('filters', $filters);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Category/Edit', [
            'category' => Category::find($category->id),
            'categories' => Category::all(),
            'categoryProperties' => DB::table('category_properties')
                ->where('category_id', $category->id)
                ->select('property_icon', 'property_name', 'property_unit', 'possible_values as property_values')
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'CategoryName' => 'required',
            'CategoryNameAr' => 'required',
            'Status' => 'required',
        ]);
        if ($request->parentCategory == 'null') $request->parentCategory = null;
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->CategoryName;
        $category->category_name_ar = $request->CategoryNameAr;
        $category->parent_category = $request->parentCategory;
        $category->status = $request->Status;
        $category->post_max_images_allow = $request->post_max_images_allow;
        $category->post_validity_interval = $request->post_validity_interval;

        if ($request->hasFile('Image')) {
            $imageName = time() . '.' . $request->Image->getClientOriginalExtension();
            $category->image = $imageName;
            $request->file('Image')->move(public_path('media/categories'), $imageName);
        }
        $category->save();
        // dd($request);
        if ($request->properties != "[]") :
            DB::table('category_properties')->where('category_id', $category->id)->delete();
            $properties = json_decode($request->properties);
            foreach ($properties as $property) :
                $property_icon = $property->property_icon;
                $property_name = $property->property_name;
                $property_unit = $property->property_unit;

                $category_property = new CategoryProperty();
                $category_property->category_id = $category->id;
                $category_property->property_icon = $property_icon;
                $category_property->property_name = $property_name;
                $category_property->property_unit = $property_unit;
                $category_property->is_mandatory = 1;
                $category_property->possible_values = json_encode($property->property_values);

                // dd($category_property);
                $category_property->save();
            endforeach;
        endif;
        return Redirect::route('panel.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('panel.category.index');
    }
}
