<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analyzer\OrderAnalyzer;


class OrderController extends Controller
{
    /**
     * @var integer
     */
    protected $perPage = 5;

    /**
     * Show the person orders.
     *
     * @param Illuminate\Http\Request
     * @param App\Analyzer\OrderAnalyzer
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, OrderAnalyzer $analyzer)
    {
        return view('show-orders')
            ->with('orders', $analyzer->getOrders($request, $this->perPage));
    }
}
