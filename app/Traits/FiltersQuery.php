<?php

namespace App\Traits;

use App\Exceptions\InvalidFilterQuery;
use App\Queries\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait FiltersQuery
{
    /**
     * Get column in database
     *
     * @param array $columns
     * @return Query
     */
    public function getColumn(array $columns = []): Query
    {
        if (count($columns) > 0) {
            $columns = array_merge(['id'], $columns);
        } else {
            $columns = $this->model->getFillable();
        }

        $this->query->select($columns);
        return $this;
    }

    /**
     * Build SQL queries by filter
     *
     * @param array $filters
     * @return $this
     * @throws InvalidFilterQuery
     */
    public function filterBy(array $filters = [])
    {
        if (!$this->filters) {
            return $this;
        }

        $fillable = $this->model->getFillable();
        foreach ($this->filters as $key => $operator) {
            // check filterBy vs fillable
            if (!in_array($key, $fillable)) {
                $allowKeys = implode(', ', $fillable);
                throw new InvalidFilterQuery("Filter by `{$key}` are not allowed. Allowed filter are `{$allowKeys}`.");
            }
//            // check param vs filterBy
            if (!array_key_exists($key, $filters)) {
                $allowKeys = implode(' | ', array_keys($this->filters));
                throw new InvalidFilterQuery("Allowed filter are `{$key}`. Filter by `{$allowKeys}` are not allowed.");
            }

            $this->filterClassification($key, $filters[$key]);
        }

        return $this;
    }

    /**
     * Add custom query
     *
     * @param array $queries
     * @return $this
     */
    public function customQuery(array $queries = [])
    {
        return $this;
    }

    /**
     * Get query
     *
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Raw query
     * @param string $sql
     * @param array $bindings
     * @param string $boolean
     * @return $this
     */
    public function rawQuery(string $sql, array $bindings = [], string $boolean = 'and')
    {
        $this->query->whereRaw($sql, $bindings, $boolean);
        return $this;
    }

    /**
     * Mapping condition filter
     *
     * @param $key
     * @param $operator
     * @return mixed|void
     */
    private function filterClassification($key, $operator)
    {
        switch ($operator) {
            case $operator == 'exact':
                return $this->customWhereExact($key, $this->filters[$key]);
            case $operator == 'partial':
                return $this->customWherePartial($key, $this->filters[$key]);
            case $operator == 'in':
                return $this->customWhereIn($key, $this->filters[$key]);
            case $operator == '=':
            default:
                return $this->customWhere($key, $this->filters[$key]);
        }
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    private function customWhereNull($key, $value) {
        return $this->query->whereNull($key, $value);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    private function customWhere($key, $value)
    {
        return $this->query->where($key, $value);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    private function customWhereIn($key, $value)
    {
        return $this->query->whereIn($key, $value);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    private function customWhereExact($key, $value)
    {
        if (Str::of($this->filters[$key])->contains(',')) {
            return $this->query->whereIn($key, explode(',', trim($this->filters[$key])));
        }
        return $this->query->customWhere($key, $value);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed|void
     */
    private function customWherePartial($key, $value)
    {
        $wrappedProperty = $this->query->getQuery()->getGrammar()->wrap($key);
        $sql = "LOWER({$wrappedProperty}) LIKE ?";
        if (is_array($value)) {
            if (count(array_filter($value)) === 0) {
                return;
            }
            return $this->query->where(function (Builder $query) use ($value, $sql) {
                foreach (array_filter($value) as $partialValue) {
                    $partialValue = mb_strtolower($partialValue, 'UTF8');
                    $this->query->orWhereRaw($sql, ["%{$partialValue}%"]);
                }
            });
        }
        $value = mb_strtolower($value, 'UTF8');
        return $this->query->whereRaw($sql, ["%{$value}%"]);
    }
}
