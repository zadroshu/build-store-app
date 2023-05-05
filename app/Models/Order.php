<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Order extends Model
  {
    use HasFactory;

    protected $fillable = [
      'name',
      'category',
      'cost',
      'discount',
      'description',
      'images',
    ];

    public function products()
    {
      return $this->belongsToMany(Product::class, 'product_order');
    }
  }
