<?php


namespace Services\Vote\Classes;


use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Services\Vote\Constants\VoteStatuses;
use Services\Vote\Contracts\FilterItemsInterface;
use Services\Vote\Models\Vote;

/**
 * Class VoteRepository
 * @package Services\Vote\Classes
 */
class VoteRepository
{

    /**
     * Insert a vote
     * @param $productKey
     * @param $userKey
     * @param $vote
     * @param int $status
     * @return mixed
     */
    public function insert($productKey, $userKey, $vote, $status = VoteStatuses::CREATED)
    {
        return Vote::create([
            'product_id' => $productKey,
            'user_id' => $userKey,
            'vote' => $vote,
            'status' => $status,
        ]);
    }

    /**
     * Check user has voted
     * @param $productKey
     * @param $userKey
     * @return bool
     */
    public function exists($productKey, $userKey): bool
    {
        return Vote::query()->where([
            'product_id' => $productKey,
            'user_id' => $userKey,
        ])->exists();
    }

    /**
     * Get votes average by product key
     * @param array $productKeys
     * @return Collection
     */
    public function getApprovedAverageByProductKeys(array $productKeys): Collection
    {
        return Vote::query()
            ->select(DB::raw('AVG(vote) as value, product_id'))
            ->whereIn('product_id', $productKeys)
            ->where('status', VoteStatuses::APPROVED)
            ->groupBy('product_id')
            ->get()->keyBy('product_id');
    }

    /**
     * Change the vote status
     * @param $key
     * @param int $status
     * @return mixed
     */
    public function changeStatus($key, $status = VoteStatuses::APPROVED)
    {
        $vote = Vote::query()->find($key);
        $vote->status = $status;
        $vote->save();
        return $vote;
    }

    public function getItems(FilterItemsInterface $filterItems): Collection
    {
        return $this->voteListBaseQuery($filterItems)->get();
    }

    public function getTotalCount(FilterItemsInterface $filterItems): int
    {
        return $this->voteListBaseQuery($filterItems, false)->count();
    }

    /**
     * @param FilterItemsInterface $filterItems
     * @param bool $checkLimit
     * @return Builder
     */
    private function voteListBaseQuery(FilterItemsInterface $filterItems, $checkLimit = true): Builder
    {
        $query = Vote::query();
        if (!is_null($filterItems->getProductKey())) {
            if (is_array($filterItems->getProductKey())) {
                $query = $query->whereIn('product_id', $filterItems->getProductKey());
            } else {
                $query = $query->whereProductId($filterItems->getProductKey());
            }
        }
        if (!is_null($filterItems->getStatus())) {
            $query = $query->whereStatus($filterItems->getStatus());
        }
        if ($checkLimit && $filterItems->getLimit() > 0) {
            $query = $query->limit($filterItems->getLimit())->offset($filterItems->getOffset());
        }
        return $query;
    }

}
