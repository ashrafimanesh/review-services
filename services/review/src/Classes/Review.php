<?php


namespace Services\Review\Classes;


use Services\Review\Constants\CommentableStatuses;
use Services\Review\Constants\VoteableStatuses;
use Services\Shop\Facades\Shop;

class Review
{
    /**
     * Check either product is commentable for all, buyers or not
     * @param $productKey
     * @param $userKey
     * @return bool
     */
    public function canCreateComment($productKey, $userKey)
    {
        /** @var ReviewSettingRepository $settingRepository */
        $settingRepository = app(ReviewSettingRepository::class);
        $setting = $settingRepository->findByProductKey($productKey);
        /**
         * By default all products should have a setting with access otherwise user can't insert the comment
         */
        if (is_null($setting) || $setting->getCommentableStatus() == CommentableStatuses::NONE) {
            return false;
        }
        if ($setting->getCommentableStatus() == CommentableStatuses::ALL) {
            return true;
        }
        return Shop::hasBought($productKey, $userKey);
    }

    /**
     * Check either product is voteable for all, buyers or not
     * @param $productKey
     * @param $userKey
     * @return bool
     */
    public function canCreateVote($productKey, $userKey)
    {
        /** @var ReviewSettingRepository $settingRepository */
        $settingRepository = app(ReviewSettingRepository::class);
        $setting = $settingRepository->findByProductKey($productKey);
        /**
         * By default all products should have a setting with access otherwise user can't insert the vote
         */
        if (is_null($setting) || $setting->getVoteableStatus() == VoteableStatuses::NONE) {
            return false;
        }
        if ($setting->getVoteableStatus() == VoteableStatuses::ALL) {
            return true;
        }
        return Shop::hasBought($productKey, $userKey);
    }
}
