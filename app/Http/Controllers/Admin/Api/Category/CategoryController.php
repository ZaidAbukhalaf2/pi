<?php

namespace App\Http\Controllers\Admin\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Repositories\Category\CategoryRepository;
use App\Services\Category\AdminCategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $adminCategoryServices;
    public function __construct(AdminCategoryServices $adminCategoryServices)
    {

        $this->adminCategoryServices = $adminCategoryServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->adminCategoryServices->getAllCategories()->collectOutputs($categories);
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryRepository $categoryRepository)
    {
        return $categoryRepository->store($request);
        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $this->adminCategoryServices->setInput('id', $id)->getCategoryById()->collectOutputs($category);
            return response()->json($category);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id, CategoryRepository $categoryRepository)
    {
        $categoryRepository->upadte($request, $id);
        return response()->json(['message' => 'Update Category successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $this->adminCategoryServices
            ->setInput('ids',  ['ids' => [$request->id]])
            ->deleteCategory();
        return response()->json(['message' => 'category status has been deleted successfully']);
    }
}
