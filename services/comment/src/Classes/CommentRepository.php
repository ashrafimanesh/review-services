<?php


namespace Services\Comment\Classes;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Services\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Services\Comment\Constants\CommentStatuses;
use Services\Comment\Contracts\FilterItemsInterface;

class CommentRepository
{

    /**
     * Insert a comment
     * @param $productKey
     * @param $userKey
     * @param $message
     * @param int $status
     * @return mixed
     */
    public function insert($productKey, $userKey, $message, $status = CommentStatuses::CREATED)
    {
        return Comment::create([
            'product_id' => $productKey,
            'user_id' => $userKey,
            'message' => $message,
            'status' => $status,
        ]);
    }

    /**
     * Change the comment status
     * @param $key
     * @param int $status
     * @return mixed
     */
    public function changeStatus($key, $status = CommentStatuses::APPROVED)
    {
        $comment = Comment::query()->find($key);
        $comment->status = $status;
        $comment->save();
        return $comment;
    }

    /**
     * Get comments count by product key
     * @param array $productKeys
     * @return Collection
     */
    public function getApprovedCountByProductKeys(array $productKeys): Collection
    {
        return Comment::query()
            ->select(DB::raw('COUNT(1) as value, product_id'))
            ->whereIn('product_id', $productKeys)
            ->where('status', CommentStatuses::APPROVED)
            ->groupBy('product_id')
            ->get()->keyBy('product_id');
    }

    public function getItems(FilterItemsInterface $filterItems): Collection
    {
        return $this->commentListBaseQuery($filterItems)->get();
    }

    public function getTotalCount(FilterItemsInterface $filterItems): int
    {
        return $this->commentListBaseQuery($filterItems, false)->count();
    }

    public function getLastComments(FilterItemsInterface $filterItems): Collection
    {
        return $this->commentListBaseQuery($filterItems)->orderBy('id', 'DESC')->get();
    }

    /**
     * @param FilterItemsInterface $filterItems
     * @param bool $checkLimit
     * @return Builder
     */
    private function commentListBaseQuery(FilterItemsInterface $filterItems, $checkLimit = true): Builder
    {
        $query = Comment::query();
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
