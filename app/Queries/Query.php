<?php

namespace App\Queries;

use App\Traits\FiltersQuery;
use App\Traits\PaginationQuery;
use App\Traits\SortsQuery;
use App\Traits\RelationshipQuery;
use Illuminate\Http\Request;

class Query
{
    use FiltersQuery, SortsQuery, RelationshipQuery, PaginationQuery;

    protected $model;

    protected $query;

    protected $filters;

    protected $sorts;

    protected $include;

    protected $pageSize;

    protected $pageNumber;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $request = app(Request::class);

        $this->model = new $model;
        $this->query = $this->model->query();
        $this->filters = $request->filter;
        $this->sorts = $request->sort;
        $this->include = $request->include;
        $this->pageSize = empty($request->page['size']) ? null : $request->page['size'];
        $this->pageNumber = empty($request->page['number']) ? null : $request->page['number'];
    }
}
