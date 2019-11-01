<?php

namespace App;

use Src\Product;
use Src\View;

class HomeController {

    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function index() {
        View::render('index');
    }
}


