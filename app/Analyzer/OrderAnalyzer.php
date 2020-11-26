<?php

namespace App\Analyzer;

use App\Models\Order;

class OrderAnalyzer extends Order
{

    /**
     * Get order data to show order page.
     * 
     * @param Illuminate\Http\Request
     * @return object
     */
    public function getOrders($request, $perPage)
    {
        return $this->timeFilter($request)->byUser()->orderBy('id','desc')->paginate($perPage);
    }

    /**
     * Check time an filter.
     * 
     * @param Illuminate\Http\Request
     * @return query
     */
    public function timeFilter($request)
    {
        return $request->filled(['from','till']) ? $this->filter($request->from, $request->till) : $this;
    }

    /**
     * Time filter.
     * 
     * @param string/object
     * @param string/object
     * @return query
     */
    public function filter($from, $till)
    {
        return $this->SearchByDate($from, $till);
    }

}
