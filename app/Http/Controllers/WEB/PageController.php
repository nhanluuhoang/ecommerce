<?php

namespace App\Http\Controllers\WEB;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use App\Models\Product;
use App\Services\CacheServices;

class PageController extends BaseController
{
    private $cacheServices;

    public function __construct(CacheServices $cacheServices)
    {
        $this->cacheServices = $cacheServices;
    }

    public function index($slug) {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();

        $category = Category::query()
            ->where('slug', $slug)
            ->where('is_public', true)
            ->firstOrFail();

        if ($category->type === CategoryTypeEnum::POST) {
            return view('post/list', compact(['categories', 'setting', 'slug']));
        } else {
            $products = Product::query()
                ->where('category_id', $category->category_id)
                ->where('status', true)
                ->get();
            return view('product/list', compact(['categories', 'setting', 'slug', 'products']));
        }
    }

    /**
     * Return Policy page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function returnPolicy() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getReturnPolicy();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }

    /**
     * Terms Of Sale page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function termsOfSale() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getTermsOfSale();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }

    /**
     * Delivery Policy page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deliveryPolicy() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getDeliveryPolicy();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }

    /**
     * Payment Methods page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function paymentMethods() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getPaymentMethods();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }

    /**
     * Information Privacy Policy page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function informationPrivacyPolicy() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getInformationPrivacyPolicy();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }

    /**
     * Store System page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeSystem() {
        $categories = $this->cacheServices->getCategories();
        $setting = $this->cacheServices->getSetting();
        $content = $this->cacheServices->getStoreSystem();
        return view('support/index', compact(['categories', 'setting', 'content']));
    }
}
