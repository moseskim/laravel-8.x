<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateReviewTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'review_tags',
            function (Blueprint $table) {
                $table->integer('review_id', false, true);
                $table->integer('tag_id', false, true);
                $table->timestamp('created_at')->nullable();
                $table->unique(['review_id', 'tag_id'], 'UNIQUE_IDX_REVIEW_TAGS');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('review_tags');
    }
}
