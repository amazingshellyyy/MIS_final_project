<?php

namespace Cart\Support\Storage\Contracts;

interface StorageInterface
{
  public function get($index);
  public function set($index, $value);
  public function all();
  public function exists($index);
  public function unsetBucket($index);
  public function clear();
}
