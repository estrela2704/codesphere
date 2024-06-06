<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabela 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'moderator', 'user']);
            $table->date('birth_date')->nullable();
            $table->string('image_url')->nullable();
            $table->text('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        // Tabela 'categories'
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        // Tabela 'tags'
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        // Tabela 'posts'
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabela 'comments'
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabela 'likes'
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'post_id']);
        });


        // Tabela pivot 'post_tag'
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('post_tag');

    }
};
