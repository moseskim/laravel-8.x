<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'tags',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('tag_name');
                $table->timestamp('created_at')->nullable();
                $table->unique(['tag_name'], 'UNIQUE_IDX_TAG_NAME');
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
        Schema::dropIfExists('tags');
    }
}
