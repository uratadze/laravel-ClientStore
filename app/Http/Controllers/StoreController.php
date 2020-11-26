<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Analyzer\StoreAnalyzer;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;

class StoreController extends Controller
{
    /**
     * @var integer
     */
    protected $perPage = 10;

    /**
     * Show the store products
     * 
     * @param Illuminate\Http\Request
     * @param App\Analyzer\StoreAnalyzer
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, StoreAnalyzer $analyzer)
    {
        return view('main-page')
            ->with('products', $analyzer->getProducts($request, $this->perPage));
    }
    
    /**
     * Prepate product picture to show
     * 
     * @param integer
     * @return image
     */
    public function getPicture($id)
    {
        $product = Product::find($id);
        if($product->header_picture_path)
        {
            $image = Image::make($product->header_picture_path);
            $response = Response::make($image->encode('jpeg'));
            $response->header('Content-Type', 'image/jpeg');
            return $response;
        }
        return Null;
    }

}
