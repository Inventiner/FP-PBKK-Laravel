<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function ensureDirectoryExists($path) {
        if (!is_dir($path)) {
            if (!mkdir($path, 0755, true)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg', // Adjust validation as needed
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);
        
        $this->ensureDirectoryExists('app/public/products');

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $imagePath = $request->file('image')->storeAs('products', $imageName, 'public');
        } else {
            $imagePath = 'default_image.jpg';
        }

        // Create and save the product
        $product = new Product;
        $product->name = $validatedData['name'];
        $product->slug = Str::limit(Str::slug($validatedData['name']), 25, '') . "-" . uniqid();
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image_path = $imagePath; 
        $product->star_rating = 0;
        $product->count_rating = 0;
        $product->user_id = Auth::id();
        $product->category_id = $validatedData['category_id'];
        $product->save();

        dd($request->all());
        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }
}