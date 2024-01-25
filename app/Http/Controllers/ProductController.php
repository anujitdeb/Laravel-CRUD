<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        //Validate Data
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpeg,jpg,gif|max:10000',
        ]);

        //Upload Image
        $imageName = time(). '.' . $request->image->extension();
        $request->image->move(public_path('/products'), $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);
        return redirect()->back()->withSuccess('Product created!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        //Validate Data
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpeg,jpg,gif|max:10000',
        ]);

        if($request->hasFile('image')){
            //Delete previous Image
            if(file_exists(public_path('products/'.$product->image))){
                unlink(public_path('products/'.$product->image));
            }

            //Upload Image
            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('/products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return back()->withSuccess('Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back()->withSuccess('Successfully deleted!');
    }
}
