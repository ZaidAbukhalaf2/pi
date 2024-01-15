<?php

namespace App\Http\Controllers\Admin\Api\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\TagRequest;
use App\Repositories\Tag\TagRepository;
use App\Services\Tag\AdminTagServices;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $adminTagServices;
    public function __construct(AdminTagServices $adminTagServices)
    {
        $this->adminTagServices = $adminTagServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->adminTagServices->getAllTags()->collectOutputs($tags);

        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, TagRepository $tagRepository)
    {

        $tagRepository->store($request);
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
        $this->adminTagServices
            ->setInput('id', $id)
            ->getTagById()
            ->collectOutputs($tag);
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, TagRepository $tagRepository, $id)
    {
        $tagRepository->upadte($request, $id);
        return response()->json(['message' => 'Update Tag successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $this->adminTagServices
            ->setInput('ids',  ['ids' => [$request->id]])
            ->deleteTag();
        return response()->json(['message' => 'Tag status has been deleted successfully']);
    }
}
