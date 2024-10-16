<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'status', 
        'total_items', 
        'total_price',
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addItem($product, $quantity, $price)
    {
        // Check if the product already exists in the cart
        $existingItem = $this->items()->where('product_id', $product)->first();
    
        if ($existingItem) {
            // If the item exists, update the quantity and subtotal
            $newQuantity = $existingItem->quantity + $quantity;
            $existingItem->updateQuantity($newQuantity);
            
            return $existingItem;
        } else {
            // If the item does not exist, create a new cart item
            $item = $this->items()->create([
                'product_id' => $product,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $quantity * $price,
            ]);
    
            // Update the cart summary
            $this->updateCartSummary();
    
            return $item;
        }
    }


    public function updateCartSummary()
    {
        $totalItems = $this->items()->count();
        $totalPrice = $this->items()->sum('subtotal');

        $this->update([
            'total_items' => $totalItems,
            'total_price' => $totalPrice,
        ]);
    }
}