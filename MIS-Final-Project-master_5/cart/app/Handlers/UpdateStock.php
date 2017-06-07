<?php

namespace Cart\Handlers;

use Cart\Handlers\Contracts\HandlerInterface;

class UpdateStock implements HandlerInterface
{
  public function handle($event)
  {
    foreach ($event->basket->all() as $product) {
      $product->increment('stock', $product->quantity);
    }
  }
}
