<?php

namespace Src;

use Src\Interfaces\Product as iProduct;
use Src\Models\Product as modelProduct;
use Src\Models\Category as modelCategory;
use Symfony\Component\HttpFoundation\Response;

class Product implements iProduct {

  public function add() {
    $productName = 'Test product';
    $categoryId = '1';
    $price = '200';
    $quantity = '5';

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
    $product = modelProduct::getProduct($productId);
    $category = modelCategory::getCategoryName($product['category_id']);

    echo "This product was added:<br>Product name: " . $product['name'] . "<br>" .
        "Price: " . $product['price'] . "<br>" .
        "Quantity: " . $product['quantity'] . "<br>" .
        "Category: " . $category . "<br>";
  }

  public function showAll() {
    $inputData = $this->getInputData();
    $this->changeCategory($inputData['productId'], $inputData['categoryId']);

    $products = modelProduct::getProducts();
    $categories = modelCategory::getCategories();

    foreach ($categories as $categoryId => $categoryName) {
      echo $categoryName . "\n";
      foreach ($products as $product) {
        if ($product['category_id'] == $categoryId) {
          echo "\nProduct name: " . $product['name'] . "\nPrice: " . $product['price'] . "\nQuantity: " . $product['quantity'] . "\n";
        }
      }
      echo "\n";
    }

    echo "\n";
  }

  public function changeCategory($productId, $categoryId) {
    $file = file_get_contents(__DIR__ . '/../data/database.json');
    $array = json_decode($file, TRUE);
    unset($file);
    foreach ($array['products'] as $key => $product) {
      if ($product['id'] == $productId) {
        $array['products'][$key]['category_id'] = $categoryId;
      }
    }
    file_put_contents(__DIR__ . '/../data/database.json', json_encode($array));
    unset($array);
  }

  private function getInputData() {
    fwrite(STDOUT, 'Move product (enter product id): ');
    $productId = trim(fgets(STDIN));
    fwrite(STDOUT, 'To category (enter category id): ');
    $categoryId = trim(fgets(STDIN));

    return $inputData = [
      'productId' => $productId,
      'categoryId' => $categoryId
    ];
  }
}