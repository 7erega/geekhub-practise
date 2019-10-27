<?php

namespace App;

use Src\Product;

class ProductController {

  private $product;

  public function __construct() {
    $this->product = new Product();
  }

  public function create() {
    $this->product->add();
  }

  public function move() {
    $this->product->showAll();
  }
}


