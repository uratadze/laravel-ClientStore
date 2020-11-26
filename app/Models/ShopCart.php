<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopCart extends Model
{
    /**
     * @var string
     */
    protected $table = 'shop_card';

    /**
     * @var array
     */
    protected $fillable = [
        'product', 'client', 'quantity'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getClient()
    {
        return $this->belongsTo(Client::class, 'client', 'id');
    }

    /**
     * Get loggedIn users shop cart.
     * 
     * @param query
     * @return query
     */
    public function scopeByUser($query)
    {
        return $query->whereHas('getClient',function($query)
        {
            $query->where('id', Auth::id());
        });
    }

    /**
     * Check if shop cart empty.
     * 
     * @return bool
     */
    public function shopCartFill()
    {
        return $this->where('client', Auth::id())->count() > 0;
    }

    /**
     * Get filled shop cart products total price.
     * 
     * @return integer
     */
    public function totalPrice()
    {
        $totalPrice = 0;
        foreach($this->byUser()->get() as $product)
        {
            $totalPrice += $product->getProduct->price * $product->quantity;
        }
        
        return $totalPrice;
    }

    /**
     * Find loggedIn shop cart product.
     * 
     * @param query
     * @param integer
     * @return query
     */
    public function scopeFindByProduct($query, $product)
    {
        return $query->where('product', $product)->where('client', Auth::id());
    }
    
}
