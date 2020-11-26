<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    /**
     * Filter by category.
     * 
     * @param query
     * @param integer
     * @return query
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Filter by searchBy.
     * 
     * @param query
     * @param string
     * @return query
     */
    public function scopeBySearch($query, $search)
    {
        return $query->where('name','like','%'.$search.'%');
    }

    /**
     * Get active products.
     * 
     * @param query
     * @return query
     */
    public function scopeProducts($query)
    {
        $query->where('status',1)->where('quantity', '!=', 0);
    }
}
