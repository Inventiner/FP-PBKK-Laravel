<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id', 
        'product_id', 
        'quantity', 
        'price', 
        'subtotal',
    ];

    protected $with = ['cart', 'product'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function updateQuantity($quantity)
    {
        $this->update([
            'quantity' => $quantity,
            'subtotal' => $this->price * $quantity,
        ]);
    
        // Update the cart summary after modifying the quantity
        $this->cart->updateCartSummary();
    }
    

    /**
     * Remove item from the cart
     */
    public function removeItem()
    {
        $this->delete();

        // Update the cart summary after removing the item
        $this->cart->updateCartSummary();
    }
}