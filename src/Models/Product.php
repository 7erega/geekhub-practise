<?php

namespace Src\Models;

class Product {

  static function getProduct($id) {
    $file = file_get_contents(__DIR__ . '/../../data/database.json');
    $array = json_decode($file, TRUE);
    unset($file);

    $productsList = array();

    foreach ($array['products'] as $product) {
      $productId = array_shift($product);
      $productsList[$productId] = $product;
    }

    return $productsList[$id];
  }
}