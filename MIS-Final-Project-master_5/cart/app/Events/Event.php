<?php

namespace Cart\Events;

use Cart\Handlers\Contracts\HandlerInterface;

class Event
{
  protected $handlers = [];

  public function attach($handlers)
  {
    // check if it is array
    // loop through $handlers if it is an array
    if (is_array($handlers)) {
      foreach($handlers as $handler) {
        if(!$handler instanceof HandlerInterface) {
          continue;
        }
        $this->handlers[] = $handler;
      }
      return;
    }

    if(!$handlers instanceof HandlerInterface) {
      return;
    }
    $this->handlers[] = $handlers;
  }
  public function dispatch()
  {
      foreach($this->handlers as $handler) {
        $handler->handle($this);
      }
  }
}
