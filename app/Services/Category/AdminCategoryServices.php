<?php

namespace App\Services\Category;

use App\Abstractions\Service;
use App\Repositories\Category\CategoryRepository;

class AdminCategoryServices extends Service
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCategories(): static
    {
        $categories = $this->categoryRepository->index();
        $this->setOutput('categories', $categories ?? []);
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCategoryById(): static
    {
        $category = $this->categoryRepository->show($this->getInput('id'));
        $this->setOutput('category', $category);
        return $this;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory(): static
    {
        $ids = $this->getInput('ids');
        $this->categoryRepository->delete($ids);
        return $this;
    }
}
