<?php

namespace App\Analyzer;

use App\Models\ShopCart;
use App\Models\Order;
use App\Models\Person;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;



class CheckoutAlanyzer extends ShopCart
{
    /**
     * Checkout products.
     *
     * @param array
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkout($person = NULL)
    {
        $filled = NULL;
        $person  = $person ? $person : (new Person)->currentPerson();
        foreach($this->byUser()->get() as $shopCart)
        {
            $filled = $shopCart;
            Order::create([
                'person'  => $person->id,
                'product' => $shopCart->product,
                'quantity'=> $shopCart->quantity,
                'status'  => 0,
            ]);
            $this->stockShortage($shopCart->product, $shopCart->quantity);
            $shopCart->delete();
        }
        return $filled ? view('checkout.show-massage') : redirect()->route('home');
    }

    /**
     * Store person info.
     *
     * @param Illuminate\Http\Request
     * @return object
     */
    public function fillPersonInfo($request)
    {
        $person = Person::create([
            'client'     => Auth::id(),
            'first_name' => $request->firstname,
            'last_name'  => $request->lastname,
            'Address'    => $request->address,
            'passport'   => $request->passport,
            'city'       => $request->city,
            'number'     => $request->number,
        ]); 
        return $this->checkout($person);
    }
    
    /**
     * Decrease products in stock.
     * 
     * @param integer
     * @param integer
     */
    public function stockShortage($productId, $quantity)
    {
        $product = Product::find($productId);
        $product->quantity = $product->quantity - $quantity;
        $product->save();
    }

}