<?php


namespace Services\Vote\Classes;


use Illuminate\Support\Collection;

class Vote
{
    public function getApprovedAverageByProductKeys(array $productKeys): Collection
    {
        /** @var VoteRepository $repository */
        $repository = app(VoteRepository::class);
        return $repository->getApprovedAverageByProductKeys($productKeys);
    }
}
