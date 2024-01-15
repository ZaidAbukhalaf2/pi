<?php

namespace App\Repositories\Tag;

use App\Http\Requests\Admin\Tag\TagRequest;
use App\Models\Tag;

class TagRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Tag::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Tag::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        return Tag::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upadte(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        return $tag->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($ids)
    {
        Tag::findOrFail($ids);
        return Tag::whereIn('id', $ids['ids'])->delete();
    }
}
