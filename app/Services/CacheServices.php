<?php

namespace App\Services;

//use App\Models\Banner;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Setting;
use App\Queries\Query;
use Illuminate\Support\Facades\Cache;

class CacheServices
{
    /**
     * @return mixed
     */
    public function getCategories()
    {
//        Cache::forget('categories');
        return Cache::rememberForever('categories', function () {
            $query = new Query(Category::class);
            $query = $query
                ->getColumn(['title', 'sort_order', 'is_public', 'parent_id', 'slug'])
                ->customQuery([
                    $query->getQuery()->where('is_public', true),
                    $query->getQuery()->orderBy('sort_order', 'asc')
                ])
                ->allowPaginate();

            return self::buildTree($query);
        });
    }

    /**
     * @param $src_arr
     * @param int $parent_id
     * @return array
     */
    public function buildTree($src_arr, int $parent_id = 0): array
    {
        $tree = array();
        foreach ($src_arr as $idx => $row) {
            if ($row['parent_id'] == $parent_id) {
                $subTree = self::buildtree($src_arr, $row['id']);
                if (count($subTree) > 0) {
                    $row['children'] = $subTree;
                }
                $tree[] = $row;
                unset($src_arr[$idx]);
            }
        }
        return $tree;
    }

    /**
     * @return mixed
     */
    public function getBanners()
    {
//        Cache::forget('banners');
        return Cache::rememberForever('banners', function () {
            return Banner::query()->where('is_public', true)->get();
        });
    }

    /**
     * @return mixed
     */
    public function getSetting()
    {
//        Cache::forget('setting');
        return Cache::rememberForever('setting', function () {
            return Setting::query()->first();
        });
    }

    /**
     * @return mixed
     */
    public function getReturnPolicy()
    {
//         Cache::forget('returnPolicy');
        return Cache::rememberForever('returnPolicy', function () {
            return Setting::query()->select('return_policy')->first()->return_policy;
        });
    }

    /**
     * @return mixed
     */
    public function getTermsOfSale()
    {
//        Cache::forget('termsOfSale');
        return Cache::rememberForever('termsOfSale', function () {
            return Setting::query()->select('terms_of_sale')->first()->terms_of_sale;
        });
    }

    /**
     * @return mixed
     */
    public function getDeliveryPolicy()
    {
//        Cache::forget('deliveryPolicy');
        return Cache::rememberForever('deliveryPolicy', function () {
            return Setting::query()->select('delivery_policy')->first()->delivery_policy;
        });
    }

    /**
     * @return mixed
     */
    public function getPaymentMethods()
    {
//        Cache::forget('paymentMethods');
        return Cache::rememberForever('paymentMethods', function () {
            return Setting::query()->select('payment_methods')->first()->payment_methods;
        });
    }

    /**
     * @return mixed
     */
    public function getInformationPrivacyPolicy()
    {
//        Cache::forget('paymentMethods');
        return Cache::rememberForever('informationPrivacyPolicy', function () {
            return Setting::query()->select('information_privacy_policy')->first()->information_privacy_policy;
        });
    }

    /**
     * @return mixed
     */
    public function getStoreSystem()
    {
//        Cache::forget('storeSystem');
        return Cache::rememberForever('storeSystem', function () {
            return Setting::query()->select('store_system')->first()->store_system;
        });
    }
}
