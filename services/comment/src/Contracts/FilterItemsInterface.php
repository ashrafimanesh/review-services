<?php


namespace Services\Comment\Contracts;


interface FilterItemsInterface
{
    /**
     * Return product key(s) to filter votes.
     *
     * @return mixed
     */
    public function getProductKey();

    /**
     * Return status of vote to filter votes by status
     * @return mixed
     */
    public function getStatus();

    /**
     * Limit number of rows
     * @return int
     */
    public function getLimit(): int;

    /**
     * Get offset
     * @return int
     */
    public function getOffset(): int;
}
