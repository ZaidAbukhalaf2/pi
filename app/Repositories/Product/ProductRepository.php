<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Product\ProductRequest;

class ProductRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('category')->paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Product::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product  = new Product();

        if ($request->hasFile('image_id')) {
            $image = $request->file('image_id');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store image in the 'storage/app/public/uploads' directory
            $image = Storage::url('uploads/' . $imageName);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image_id = $request->image_id;
        return $product->save();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upadte(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image_id')) {
            $image = $request->file('image_id');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store image in the 'storage/app/public/uploads' directory
            $image = Storage::url('uploads/' . $imageName);
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->image_id = $request->image_id;
        return $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($ids)
    {
        Product::findOrFail($ids);
        return Product::whereIn('id', $ids['ids'])->delete();
    }
}
