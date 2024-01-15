<?php

namespace App\Services\ProductTag;

use App\Abstractions\Service;
use App\Repositories\ProductTag\ProductTagRepository;

class AdminProductTagServices extends Service
{
    protected $productTagRepository;

    public function __construct(ProductTagRepository $productTagRepository)
    {

        $this->productTagRepository = $productTagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProductTag(): static
    {
        $productTags = $this->productTagRepository->index();
        $this->setOutput('productTags', $productTags ?? []);
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProtectTagById(): static
    {
        $productTag = $this->productTagRepository->show($this->getInput('id'));
        $this->setOutput('productTag', $productTag);
        return $this;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProtectTag(): static
    {
        $ids = $this->getInput('ids');
        $this->productTagRepository->delete($ids);
        return $this;
    }
}
