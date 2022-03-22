<?php

namespace App\Traits;

use App\Enums\SortDirection;
use App\Exceptions\InvalidSortQuery;

trait SortsQuery
{

    /**
     * Build SQL queries by sort
     *
     * @param array $sorts
     * @return $this
     * @throws InvalidSortQuery
     */
    public function sortFieldsBy(array $sorts = [])
    {
        if (!$this->sorts) {
            return $this;
        }

        $sortFieldAndValue = $this->getSortFields();
        $fillable = $this->model->getFillable();

        foreach ($this->sorts as $key) {
            // check sortBy vs fillable
            if (!in_array($key, $fillable)) {
                $allowKeys = implode(', ', $fillable);
                throw new InvalidSortQuery("Sort by `{$key}` are not allowed. Allowed sort are `{$allowKeys}`.");
            }
            // check param vs sortBy
            if (!in_array($key, $sorts)) {
                $allowKeys = implode(' | ', array_keys($sortFieldAndValue));
                throw new InvalidSortQuery("Allowed sort are `{$key}`. Sort by `{$allowKeys}` are not allowed.");
            }

            $this->sortClassification($key, $sortFieldAndValue[$key]);
        }

        return $this;
    }

    /**
     * Get params sort and parse sort direction
     *
     * @return array
     */
    private function getSortFields(): array
    {
        $sortFieldAndValue = [];

        if (is_string($this->sorts)) {
            $this->sorts = explode(',', $this->sorts);
        }

        foreach ($this->sorts as $item) {
            $sortValue = $this->parseSortDirection($item);
            $sortFieldAndValue[$item] = $sortValue;
        }

        return $sortFieldAndValue;
    }

    /**
     * @param string $value
     * @return string
     */
    private function parseSortDirection(string $value): string
    {
        return strpos($value, '-') === 0 ? SortDirection::DESCENDING : SortDirection::ASCENDING;
    }

    /**
     * @param $key
     * @param $sortDirection
     * @return mixed
     */
    private function sortClassification($key, $sortDirection)
    {
        return $this->query->orderBy($key, $sortDirection);
    }
}
