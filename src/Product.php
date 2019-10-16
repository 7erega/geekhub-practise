<?php

namespace Src;

use Src\Interfaces\Product as iProduct;
use Src\Models\Product as modelProduct;

class Product implements iProduct {

  public function add() {
    fwrite(STDOUT, 'Enter product name: ');
    $productName = trim(fgets(STDIN));
    fwrite(STDOUT, 'Enter category id: ');
    $categoryId = trim(fgets(STDIN));
    fwrite(STDOUT, 'Enter price: ');
    $price = trim(fgets(STDIN));
    fwrite(STDOUT, 'Enter quantity: ');
    $quantity = trim(fgets(STDIN));

    $file = file_get_contents(__DIR__ . '/../data/database.json');
    $array = json_decode($file, TRUE);
    unset($file);
    $arrayLength = count($array['products']);
    $lastElement = $array['products'][$arrayLength - 1];
    array_push($array['products'], array(
      'id' => ++$lastElement['id'],
      'name' => $productName,
      'category_id' => $categoryId,
      'price' => $price,
      'quantity' => $quantity
    ));
    file_put_contents(__DIR__ . '/../data/database.json', json_encode($array));
    unset($array);

    $this->show($lastElement['id']);
  }

  public function show($productId) {
    $result = modelProduct::getProduct($productId);

    print_r($result);
  }

  public function showAll() {

  }

  public function changeCategory($prodtcId, $categoryId) {

  }
}