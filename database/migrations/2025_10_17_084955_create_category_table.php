<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $data =  array(
            [
                'name' => 'Smartphones',
            ],
            [
                'name' => 'Laptops',
            ],
            [
                'name' => 'Tablets',
            ],
            [
                'name' => 'Gaming Consoles',
            ],
        );
        foreach ($data as $datum){
            $category = new Category();
            $category->name =$datum['name'];
            $category->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
