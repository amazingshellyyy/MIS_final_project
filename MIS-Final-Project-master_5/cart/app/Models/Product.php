<?php
namespace Cart\Models;

use Cart\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class Product extends Model
{
  public $quantity = null;

  public function hasLowStock()
  {
      if($this->outOfStock()){
        return false;
      }
      return (bool)($this->stock <= 5);
  }

  public function outOfStock()
  {
      return $this->stock === 0;
  }

  public function inStock()
  {
      return $this->stock >= 1;
  }

  public function hasStock($quantity)
  {
      return $this->stock >= $quantity;
  }

  public function order()
  {
      return $this->belongsToMany(Order::class, 'orders_products')->withPivot('quantity');
  }

  public function getRating()
  {
      return $this->rating;
  }

  public function getID()
  {
      return DB::table('orders_products')
                ->where('product_id', $this->id)
                ->groupBy('product_id')
                ->count();
  }

}
