<?php


namespace Services\Comment\Classes;


use Illuminate\Support\Collection;

class Comment
{
    public function getApprovedCountByProductKeys(array $productKeys): Collection
    {
        /** @var CommentRepository $repository */
        $repository = app(CommentRepository::class);
        return $repository->getApprovedCountByProductKeys($productKeys);
    }
}
