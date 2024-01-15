<?php

namespace App\Http\Controllers\Admin\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductTag\AdminProductTagServices;
use App\Http\Requests\Admin\ProductTag\ProductTagRequest;
use App\Repositories\ProductTag\ProductTagRepository;

class ProductTagController extends Controller
{

    protected $adminProductTagServices;
    public function __construct(AdminProductTagServices $adminProductTagServices)
    {
        $this->adminProductTagServices = $adminProductTagServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->adminProductTagServices->getAllProductTag()
            ->collectOutputs($productTags);
        return response()->json($productTags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTagRequest $request, ProductTagRepository $productTagRepository)
    {
        $productTagRepository->store($request);
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
            $this->adminProductTagServices->setInput('id', $id)->getProtectTagById()->collectOutputs($productTag);
            return response()->json($productTag);
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
    public function update(ProductTagRequest $request, ProductTagRepository $productTagRepository, $id)
    {
        $productTagRepository->upadte($request, $id);
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->adminProductTagServices
            ->setInput('ids',  ['ids' => [$request->id]])
            ->deleteProtectTag();
        return response()->json(['message' => 'Tag status has been deleted successfully']);
    }
}
