<?php

use App\Models\Category;
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
    Schema::create('Category', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->longText('description');
      $table->timestamps();
    });

    // relation: one category to many products
    Schema::table('product', function (Blueprint $table) {
      $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnDelete();
    });
  }
  
  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('category');
    Schema::table('product', function (Blueprint $table) {
      $table->dropForeignIdFor(Category::class);
    });
  }
};
