<?php

namespace App;

use Src\Product;

class ProductController {

  private $product;

  public function __construct() {
    $this->product = new Product();
  }

  public function create() {
    $this->product->create();
  }

  public function move() {
    $this->product->showAll();
  }
}


