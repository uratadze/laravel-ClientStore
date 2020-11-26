<?php

namespace App\Analyzer;

use App\Models\Product;

class StoreAnalyzer extends Product
{
    /**
     * Get filtered products.
     * 
     * @param Illuminate\Http\Request
     * @param integer
     * @return object;
     */
    public function getProducts($request, $perPage)
    {
        $this->request = $request;
        return $this->productFilter()->paginate($perPage);
    }

    /**
     * Get filtered container wthich include category and searchBy filter.
     * 
     * @return object;
     */
    public function productFilter()
    {
        
        return $this->request->filled('category') ? $this->products()->byCategory($this->request->category) : $this->searchFilter();
    }

    /**
     * Get searchBy filter.
     * 
     * @return object
     */
    public function searchFilter()
    {
        return $this->request->filled('search') ?  $this->products()->bySearch($this->request->search) : $this->products();
    }
}