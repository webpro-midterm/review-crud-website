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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained()->onDelete('cascade'); // Foreign key referencing reviews
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users
            $table->text('content'); // Comment content
            $table->unsignedBigInteger('parent_id')->nullable(); // Nullable parent_id for replies
            $table->timestamps();
            $table->unsignedInteger('likes_count')->default(0);
            // Add a foreign key constraint for parent_id
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Drop foreign key if necessary
            $table->dropColumn('likes_count'); // Drop likes_count column
        });
        
        Schema::dropIfExists('comments'); // Drop the comments table
    }
};
