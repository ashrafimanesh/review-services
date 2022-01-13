<?php


namespace Services\Review\Classes;


use Illuminate\Support\Collection;
use Services\Comment\Facades\Comment;
use Services\Review\Contracts\ReviewSettingInterface;
use Services\Review\Models\ReviewSetting;
use Services\Vote\Facades\Vote;

class ReviewSettingRepository
{
    public function findByProductKey($productKey): ?ReviewSettingInterface
    {
        return ReviewSetting::query()->whereProductId($productKey)->first();
    }

    public function updateCommentable($productKey, $commentable)
    {
        return ReviewSetting::query()->whereProductId($productKey)->update([
            'commentable' => $commentable
        ]);
    }

    public function updateVoteable($productKey, $voteable)
    {
        return ReviewSetting::query()->whereProductId($productKey)->update([
            'voteable' => $voteable
        ]);
    }

    public function getByProductsWithDetails(array $productKeys): Collection
    {
        // Get settings by products id
        $settings = ReviewSetting::query()->whereIn('product_id', $productKeys)
            ->get()
            ->keyBy('product_id');

        $commentableProducts = [];
        $voteableProducts = [];
        //Check commentable and voteable products to count
        foreach($settings as $setting) {
            if ($setting->isCommentable()) {
                $commentableProducts[] = $setting->product_id;
            }
            if ($setting->isVoteable()) {
                $voteableProducts[] = $setting->product_id;
            }
        }

        $comments = count($commentableProducts) > 0
            ? Comment::getApprovedCountByProductKeys($commentableProducts)
            : collect([]);

        $votes = count($commentableProducts) > 0
            ? Vote::getApprovedAverageByProductKeys($commentableProducts)
            : collect([]);

        foreach ($settings as $setting) {
            $setting->comments_count = $comments[$setting->product_id]->value ?? 0;
            $setting->vote_average = $votes[$setting->product_id]->value ?? 0;
        }


        return $settings;
    }
}
