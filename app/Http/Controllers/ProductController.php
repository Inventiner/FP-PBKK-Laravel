<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function ensureDirectoryExists($path) {
        if (!is_dir($path)) {
            if (!mkdir($path, 0755, true)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
            }
        }
    }
    
    public function upload()
    {
        return view('product.create', ['categories' => Category::all()]);
    }

    public function edit($slug)
    {
        $user = Auth::user();

        $product = Product::where('slug', $slug)
                        ->where('user_id', $user->id)
                        ->first(); 

        if (!$product) {
            abort(442); 
        }

        $categories = Category::all(); 
        return view('product.edit', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
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
        $product->image_path = "storage/". $imagePath; 
        $product->star_rating = 0;
        $product->count_rating = 0;
        $product->user_id = Auth::id();
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return redirect()->route('dashboard')
        ->with('success', 'Product updated successfully!');
    }

    public function update(Request $request) 
    {
        $product = Product::where('id', request()->id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.'); 
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'sometimes|image|',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension(); 
            $imagePath = $request->file('image')->storeAs('products', $imageName, 'public');
            $validatedData['image_path'] = "storage/". $imagePath;
        }

        $product->update($validatedData);

        return redirect()->route('dashboard')
        ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product = Product::where('id', request()->id)->first();
        
        $product->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Product deleted successfully.');
    }
}