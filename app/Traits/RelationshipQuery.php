<?php

namespace App\Traits;

use App\Exceptions\InvalidRelationQuery;

trait RelationshipQuery
{

    /**
     * Build SQL queries relationship
     *
     * @param array $include
     * @return $this
     * @throws InvalidRelationQuery
     */
    public function includeRelationShip(array $include = [])
    {
        if (!$this->include) {
            return $this;
        }

        $relationParams = $this->getRelation();

        if ($include !== $relationParams) {
            $allowKeys = implode('', $include);
            throw new InvalidRelationQuery("Allowed relationship are `{$allowKeys}`.");
        }

        $this->includeClassification($this->include);

        return $this;
    }

    /**
     * Get params include
     *
     * @return array
     */
    private function getRelation(): array
    {
        $relation = [];

        if (is_string($this->include)) {
            $relation = explode(',', $this->include);
        }

        return $relation;
    }

    /**
     * @param $relations
     * @return mixed
     */
    private function includeClassification($relations)
    {
        return $this->query->with(explode(',', $this->include));
    }
}
