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

    public function setProduct($data)
    {
        $arrayLength = count($this->fileContent['products']);
        $lastElement = $this->fileContent['products'][$arrayLength - 1];
        array_push($this->fileContent['products'], array(
          'id' => ++$lastElement['id'],
          'name' => $data['productName'],
          'category_id' => $data['categoryId'],
          'price' => $data['price'],
          'quantity' => $data['quantity'],
        ));
        file_put_contents(__DIR__ . '/../../data/database.json', json_encode($this->fileContent));

        return $lastElement['id'];
    }

    public function changeCategory($productId, $categoryId)
    {
        foreach ($this->fileContent['products'] as $key => $product) {
            if ($product['id'] == $productId) {
                $this->fileContent['products'][$key]['category_id'] = $categoryId;
            }
        }
        file_put_contents(__DIR__ . '/../../data/database.json', json_encode($this->fileContent));
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
