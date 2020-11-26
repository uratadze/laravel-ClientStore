<?php

namespace App\Analyzer;

use App\Models\Product;
use App\Models\ShopCart;
use Illuminate\Support\Facades\Auth;

class ShopCartAnalyzer extends ShopCart
{

    /**
     * Get item data by user to show products in shop cart.
     * 
     * @param Illuminate\Http\Request
     * @param integer
     * @return object
     */
    public function getItems($request, $perPage)
    {
        return $this->byUser()->paginate($perPage);
    }

    /**
     *  Update and check shop cart.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Support\Facades\Response
     */
    public function submit($request)
    {
        $response = $this->updateShopCart($request->quantity) ? back()->with('error', __("მსგავსი რაოდენობის პროდუქცია არ არის !")) : $this->submitResponse($request->action);
        return $this->shopCartFill() ? $response : back()->with('error', __("კალათა ცარიელია !"));
    }

    /**
     * Check submit.
     * 
     * @param string
     * @return Illuminate\Support\Facades\Response
     */
    public function submitResponse($action)
    {
        return $action == 'checkout' ? redirect()->route('shop.cart.checkout') : back()->with('success', __('კალათა განახლდა !'));
    }

    /**
     * Update shop cart proudct
     * 
     * @param array
     * @param bool
     * @return bool 
     */
    public function updateShopCart($products, $sum=False)
    {
        $error = False;
        foreach($products as $id => $quantity)
        {
            $shopcartItems = $this->findByProduct($id);
            $quantity = $this->getProductQuantity($shopcartItems, $quantity, $sum);
            if($quantity == Null)
            {
                $error = True;
                continue;
            }
            $shopcartItems->update([
                'quantity' => $quantity
            ]);
        }
        return $error;
    }

    /**
     * Check and get product quantity.
     * 
     * @param App\Models\ShopCart
     * @param integer
     * @param bool
     * @return integer
     */
    public function getProductQuantity($shopcartItems, $requestQuantity, $sum)
    {
        $quantity = $shopcartItems->first();
        $requestQuantity = $sum ? $quantity->quantity + $requestQuantity : $requestQuantity;
        return $quantity->getProduct->quantity >= $requestQuantity ? $requestQuantity : Null;
    }

    /**
     * Store product in shop cart.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Support\Facades\Response
     */
    public function addProduct($request)
    {
        return $this->findByProduct($request->product)->count() > 0 ? $this->updateProductOnShopCart($request->product, $request->quantity) : $this->addProductOnShopCart($request->product, $request->quantity);
    }

    /**
     * Add new product in shop cart.
     * 
     * @param integer
     * @param integer
     * @return Illuminate\Support\Facades\Response
     */
    public function addProductOnShopCart($product, $quantity) 
    {
        $this->create([
            'product'  => $product,
            'quantity' => $quantity,
            'client'   => Auth::id(),
        ]);
        return back()->with('success', __('პროდუქტი წარმატებით დაემატა კალათაში'));
    }
    
    /**
     * Update new product in shop cart.
     * 
     * @param integer 
     * @param integer
     * @return Illuminate\Support\Facades\Response
     */
    public function updateProductOnShopCart($product, $quantity) 
    {        
        $order[$product] = $quantity;
        return $this->updateShopCart($order, True) ? back()->with('error', __("კალათაში არსებული პროდუქტის რაოდენობა აღემატება მარაგის რაოდენობას !")) : back()->with('success', __('პროდუქტი წარმატებით განახლდა კალათაში'));
    }    

}