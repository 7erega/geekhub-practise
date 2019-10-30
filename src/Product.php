<?php

namespace Src;

use Src\Interfaces\Product as iProduct;
use Src\Models\Product as modelProduct;
use Src\Models\Category as modelCategory;

class Product implements iProduct
{
    private $modelProduct;
    private $modelCategory;

    public function __construct()
    {
        $this->modelProduct = new modelProduct();
        $this->modelCategory = new modelCategory();
    }

    public function create()
    {
        $productName = 'Test product';
        $categoryId = '1';
        $price = '200';
        $quantity = '5';

        $data = [
          'productName' => $productName,
          'categoryId' => $categoryId,
          'price' => $price,
          'quantity' => $quantity,
        ];

        $lastElementId = $this->modelProduct->setProduct($data);

        $this->show($lastElementId);
    }

    public function show($productId)
    {
        $product = $this->modelProduct->getProduct($productId);
        $category = $this->modelCategory->getCategoryName($product['category_id']);

        echo "This product was added:<br>Product name: " . $product['name'] . "<br>" .
        "Price: " . $product['price'] . "<br>" .
        "Quantity: " . $product['quantity'] . "<br>" .
        "Category: " . $category . "<br>";
    }

    public function showAll()
    {
        $products = $this->modelProduct->getProducts();
        $categories = $this->modelCategory->getCategories();

        foreach ($categories as $categoryId => $categoryName) {
            echo $categoryName . "<br>";
            foreach ($products as $product) {
                if ($product['category_id'] == $categoryId) {
                    echo "<br>Product name: " . $product['name'] . "<br>Price: " . $product['price'] . "<br>Quantity: " . $product['quantity'] . "<br>";
                }
            }
            echo "<br>";
        }

        echo "<br>";
    }

    public function changeCategory()
    {
        $inputData = $this->getInputData();
        $productId = $inputData['productId'];
        $categoryId = $inputData['categoryId'];

        $file = file_get_contents(__DIR__ . '/../data/database.json');
        $array = json_decode($file, true);
        unset($file);
        foreach ($array['products'] as $key => $product) {
            if ($product['id'] == $productId) {
                $array['products'][$key]['category_id'] = $categoryId;
            }
        }
        file_put_contents(__DIR__ . '/../data/database.json', json_encode($array));
        unset($array);
    }

    private function getInputData()
    {
        $productId = 5;
        $categoryId = 3;

        return $inputData = [
          'productId' => $productId,
          'categoryId' => $categoryId
        ];
    }
}
