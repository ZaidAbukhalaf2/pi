<?php

namespace App\Repositories\ProductTag;

use App\Http\Requests\Admin\ProductTag\ProductTagRequest;
use App\Models\product_tag;

class ProductTagRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    
        return product_tag::with('product','tag')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return product_tag::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTagRequest $request)
    {

        $productTag = new product_tag();
        $productTag->product_id = $request->product_id;
        $productTag->tag_id = $request->tag_id;
        return $productTag->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upadte(ProductTagRequest $request, $id)
    {
        $product_tag = product_tag::findOrFail($id);
        $product_tag->product_id = $request->product_id;
        $product_tag->tag_id = $request->tag_id;
        return $product_tag->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($ids)
    {
        product_tag::findOrFail($ids);
        return product_tag::whereIn('id', $ids['ids'])->delete();
    }
}
