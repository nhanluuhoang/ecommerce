<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use App\Queries\Query;

class AddressController extends ApiBaseController
{

    /**
     *  Display a listing of the addresses.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\InvalidFilterQuery
     */
    public function index()
    {
        $addresses = new Query(Address::class);
        $addresses = $addresses->filterBy([
            'kind'      => '=',
            'parent_id' => '='
        ])->allowPaginate();

        return $this->httpOK($addresses);
    }
}
