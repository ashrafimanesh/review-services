<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Services\Review\Constants\CommentableStatuses;
use Services\Review\Constants\VoteableStatuses;

class CreateReviewSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->unique();
            $table->tinyInteger('commentable')->default(CommentableStatuses::ALL)->comment('2: everyone, 1:buyers, 0: none');
            $table->tinyInteger('voteable')->default(VoteableStatuses::ALL)->comment('2: everyone, 1:buyers, 0: none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_settings');
    }
}
