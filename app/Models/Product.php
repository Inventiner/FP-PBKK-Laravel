<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image_path',
        'star_rating',
        'count_rating',
        'user_id',
        'category_id',
    ];

    protected $with = ['user', 'category'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'category_id');
    }

    public function scopeFilter(Builder $query, array $filters): void 
    {
        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) => 
            $query->where('name', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) => 
            $query->whereHas('category', fn($query) => $query->where('slug', $category))
        );
        
        $query->when(
            $filters['user'] ?? false,
            fn($query, $user) => 
            $query->whereHas('user', fn($query) => $query->where('username', $user))
        );
    }
}
