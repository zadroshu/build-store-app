<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Product extends Model
  {
    use HasFactory;

    protected $fillable = [
      'name',
      'category_id',
      'cost',
      'discount',
      'description',
      'image',
      'in_stock',
    ];

    public function orders()
    {
      return $this->belongsToMany(Order::class, 'product_order');
    }

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
  }
