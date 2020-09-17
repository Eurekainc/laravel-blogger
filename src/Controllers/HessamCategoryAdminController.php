<?php

namespace HessamDev\Hessam\Controllers;

use App\Http\Controllers\Controller;
use HessamDev\Hessam\Events\CategoryAdded;
use HessamDev\Hessam\Events\CategoryEdited;
use HessamDev\Hessam\Events\CategoryWillBeDeleted;
use HessamDev\Hessam\Helpers;
use HessamDev\Hessam\Middleware\UserCanManageBlogPosts;
use HessamDev\Hessam\Models\HessamCategory;
use HessamDev\Hessam\Requests\DeleteHessamCategoryRequest;
use HessamDev\Hessam\Requests\StoreHessamCategoryRequest;
use HessamDev\Hessam\Requests\UpdateHessamCategoryRequest;

/**
 * Class HessamCategoryAdminController
 * @package HessamDev\Hessam\Controllers
 */
class HessamCategoryAdminController extends Controller
{
    /**
     * HessamCategoryAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
    }

    /**
     * Show list of categories
     *
     * @return mixed
     */
    public function index(){

        $categories = HessamCategory::orderBy("category_name")->paginate(25);
        return view("hessam_admin::categories.index")->withCategories($categories);
    }

    /**
     * Show the form for creating new category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create_category(){

        return view("hessam_admin::categories.add_category",[
            'category' => new \HessamDev\Hessam\Models\HessamCategory(),
            'categories_list' => HessamCategory::orderBy("category_name")->get()
        ]);

    }

    /**
     * Store a new category
     *
     * @param StoreHessamCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_category(StoreHessamCategoryRequest $request){
        if ($request['parent_id']== 0){
            $request['parent_id'] = null;
        }
        $new_category = HessamCategory::create($request->all());

        Helpers::flash_message("Saved new category");

        event(new CategoryAdded($new_category));
        return redirect( route('hessam.admin.categories.index') );
    }

    /**
     * Show the edit form for category
     * @param $categoryId
     * @return mixed
     */
    public function edit_category($categoryId){
        $category = HessamCategory::findOrFail($categoryId);
        return view("hessam_admin::categories.edit_category",[
            'categories_list' => HessamCategory::orderBy("category_name")->get()
        ])->withCategory($category);
    }

    /**
     * Save submitted changes
     *
     * @param UpdateHessamCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update_category(UpdateHessamCategoryRequest $request, $categoryId){
        /** @var HessamCategory $category */
        $category = HessamCategory::findOrFail($categoryId);
        $category->fill($request->all());
        $category->save();

        Helpers::flash_message("Saved category changes");
        event(new CategoryEdited($category));
        return redirect($category->edit_url());
    }

    /**
     * Delete the category
     *
     * @param DeleteHessamCategoryRequest $request
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy_category(DeleteHessamCategoryRequest $request, $categoryId){

        /* Please keep this in, so code inspections don't say $request was unused. Of course it might now get marked as left/right parts are equal */
        $request=$request;

        $category = HessamCategory::findOrFail($categoryId);
        event(new CategoryWillBeDeleted($category));
        $category->delete();

        return view ("hessam_admin::categories.deleted_category");

    }

}
