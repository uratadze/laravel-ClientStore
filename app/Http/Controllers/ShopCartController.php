<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analyzer\ShopCartAnalyzer;

class ShopCartController extends Controller
{
    /**
     * @var integer
     */
    protected $perPage = 5;

    /**
     * Create a new analyzer instance.
     *
     * @param App\Analyzer\ShopCartAnalyzer
     * @return void
     */
    public function __construct(ShopCartAnalyzer $analyzer)
    {
        $this->analyzer = $analyzer;
    }

    /**
     * Show the application shop cart items.
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('shop-cart')
            ->with('items', $this->analyzer->getItems($request, $this->perPage));
    }

    /**
     * Remove the person shop cart item.
     *
     * @param integer
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function removeCart($id)
    {
        $this->analyzer->find($id)->delete();
        return back()->with('success', __('პროდუქტი წარმატებით წაიშალა !'));    
    }

    /**
     * Update/Checkout the person shop cart.
     *
     * @param Illuminate\Http\Request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submitCart(Request $request)
    { 
        return $this->analyzer->submit($request);
    }

    /**
     * Add product in shop cart from stock.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Support\Facades\Response
     */
    public function add(Request $request)
    {
        return $this->analyzer->addProduct($request);
    }
    
}
