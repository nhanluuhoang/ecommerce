<?php

namespace App\Http\Controllers\WEB;

use App\Models\Product;
use App\Services\CacheServices;

class HomeController extends BaseController
{
    private $cacheServices;

    public function __construct(CacheServices $cacheServices)
    {
        $this->cacheServices = $cacheServices;
    }

    public function index()
    {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $banners = $this->cacheServices->getBanners();

        //TODO: feature set new product
        $newProducts = Product::query()->limit(4)->get();

        //TODO: feature set best sale product
        $bestSaleProducts = Product::query()->limit(4)->get();

        return view('home/index', compact([
            'categories', 'setting', 'banners', 'newProducts', 'bestSaleProducts'
        ]));
    }
}
