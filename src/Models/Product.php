<?php

namespace Src\Models;

class Product
{
    private $fileContent;
    private $id;
    private $name;
    private $categoryId;
    private $price;
    private $quantity;

    public function __construct()
    {
        $file = file_get_contents(__DIR__ . '/../../data/database.json');
        $this->fileContent = json_decode($file, true);
        unset($file);
    }

    public function getProduct($id)
    {
        $productsList = array();

        foreach ($this->fileContent['products'] as $product) {
            $productId = array_shift($product);
            $productsList[$productId] = $product;
        }

        return $productsList[$id];
    }

    public function getProducts()
    {
        return $this->fileContent['products'];
    }
}
