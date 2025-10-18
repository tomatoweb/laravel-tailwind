<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    // allowed props list
    protected $fillable = ['name'];

    // banned props list
    protected $guarded = [];

    public function products() {
      return $this->hasMany(Product::class);
    } 
}
