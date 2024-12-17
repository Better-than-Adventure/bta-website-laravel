<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary');
            $table->string('slug');
            $table->text('content');
            $table->boolean('draft')->default(true);
            $table->timestamp('published_at');
            $table->integer('post_type_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('post_type_id')->references('id')->on('post_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
