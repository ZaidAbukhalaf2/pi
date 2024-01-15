<?php

namespace App\Services\Tag;

use App\Abstractions\Service;
use App\Repositories\Tag\TagRepository;

class AdminTagServices extends Service
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {

        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTags(): static
    {
        $tags = $this->tagRepository->index();
        $this->setOutput('tags', $tags ?? []);
        return $this;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTagById(): static
    {
        $tag = $this->tagRepository->show($this->getInput('id'));
        $this->setOutput('tag', $tag);
        return $this;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTag(): static
    {
        $ids = $this->getInput('ids');
        $this->tagRepository->delete($ids);
        return $this;
    }
}
