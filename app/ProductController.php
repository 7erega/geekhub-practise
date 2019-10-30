<?php

namespace App;

use Src\Product;

class ProductController {

  private $product;

  public function __construct() {
    $this->product = new Product();
  }

    public function showAll() {
        $this->product->showAll();
    }

  public function create() {
    $this->product->create();
  }

  public function move() {
      $this->product->changeCategory();
    $this->product->showAll();
  }
}


