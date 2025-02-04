<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    // allowed props list
    protected $fillable = [
      'id',
     'name' 
    ];

    // banned props list
    protected $guarded = [];

    public function category(){
      return $this->belongsTo(Category::class);
    }
}
