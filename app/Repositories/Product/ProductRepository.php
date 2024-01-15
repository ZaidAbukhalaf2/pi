<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\Media_file;
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

        return Product::with('category')->get();
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

        // Validate the request
        $request->validate([
            'image_id' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        // Upload the image
        if ($request->hasFile('image_id')) {
            $imagePath = $request->file('image_id')->store('public/images/product');


            // Create a new Media_file record

            $media = Media_file::create([
                'file_name'      => $request->file('image_id')->getClientOriginalName(),
                'file_path'      => str_replace('public/', '', $imagePath),
                'file_size'      =>  $request->file('image_id')->getSize(),
                'file_type'      =>  $request->file('image_id')->getMimeType(),
                'file_extension' =>  $request->file('image_id')->getClientOriginalExtension(),
            ]);
        }
        // Create a new Product record
        return Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            // 'image_id' => $media->id
        ]);
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
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        return  $product->save();

        // Validate the request
        // $request->validate([
        //     'image_id' => 'image|mimes:jpeg,png,jpg,gif',
        // ]);

        // Upload the image
        // $imagePath = $request->file('image_id')->store('public/images/users');

        // if (Storage::exists($imagePath)) {
        //     // Delete the old image
        //     Storage::delete($imagePath);
        // }

        // Update a new Media_file record
        // $media = media_file::find($product->image_id);
        // $media->file_name = $request->file('image_id')->getClientOriginalName();
        // $media->file_path = str_replace('public/', '', $imagePath);
        // $media->file_size = $request->file('image_id')->getSize();
        // $media->file_type = $request->file('image_id')->getMimeType();
        // $media->file_extension = $request->file('image_id')->getClientOriginalExtension();
        // $media->save();
        // $product->image_id = $media->id;


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

        // foreach ($product as $image) {
        //     media_file::find($image->image_id)->delete();
        // }
        return Product::whereIn('id', $ids['ids'])->delete();
    }
}
