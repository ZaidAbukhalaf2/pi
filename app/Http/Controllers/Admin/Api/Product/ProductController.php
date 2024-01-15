<?php

namespace App\Http\Controllers\Admin\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\AdminProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $adminProductServices;
    public function __construct(AdminProductServices $adminProductServices)
    {

        $this->adminProductServices = $adminProductServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->adminProductServices->getAllProducts()->collectOutputs($products);
        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductRepository $productRepository)
    {
        $productRepository->store($request);
        return response()->json(['message' => 'Create Product Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->adminProductServices->setInput('id', $id)->getProductById()->collectOutputs($product);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, ProductRepository $productRepository, $id)
    {
        $productRepository->upadte($request, $id);
        return response()->json(['message' => 'Update Product Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->adminProductServices
            ->setInput('ids',  ['ids' => [$request->id]])
            ->deleteProduct();
        return response()->json(['message' => 'deleted']);
    }
}
