<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
      if ($oldCart) {
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }

    public function add($item, $id) {
      $storedItem = ['qty' => 0, 'price' => $item->cost, 'item' => $item];
      if ($this->items) {
        if (array_key_exists($id, $this->items)) {
          $storedItem = $this->items[$id];
        }
      }
      $storedItem['qty']++;
      $storedItem['price'] = $item->cost * $storedItem['qty'];
      $this->items[$id] = $storedItem;
      $this->totalQty++;
      $this->totalPrice += $item->cost;
    }
}
