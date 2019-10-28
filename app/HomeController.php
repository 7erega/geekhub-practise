<?php

namespace App;

use Src\Product;

class HomeController {

    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function index() {
        $this->product->showAll();
    }
}


