<?php

namespace App\Traits;

use App\Enums\PageEnum;

trait PaginationQuery
{
    /**
     * @return mixed
     */
    public function allowPaginate()
    {
        if (!$this->hasPaginate()) {
            return $this->query->get();
        }

        return $this->query->paginate(
            $this->pageSize ?? PageEnum::PAGE_SIZE,
            ['*'],
            'page[number]',
            $this->pageNumber ?? PageEnum::PAGE_NUMBER
        );
    }

    /**
     * @return bool
     */
    protected function hasPaginate(): bool
    {
        return $this->pageSize || $this->pageNumber;
    }
}
