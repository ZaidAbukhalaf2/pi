<?php

namespace App\Services\Product;

use App\Abstractions\Service;
use App\Repositories\Product\ProductRepository;

class AdminProductServices extends Service
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {

        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProducts(): static
    {
        $products = $this->productRepository->index();
        $this->setOutput('products', $products ?? []);
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductById(): static
    {
        $product = $this->productRepository->show($this->getInput('id'));
        $this->setOutput('products', $product);
        return $this;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(): static
    {
        $ids = $this->getInput('ids');
        $this->productRepository->delete($ids);
        return $this;
    }
}
