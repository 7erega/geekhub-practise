<?php

namespace Src;

use Src\Interfaces\Product as iProduct;
use Src\Models\Product as modelProduct;
use Src\Models\Category as modelCategory;
use Symfony\Component\HttpFoundation\Request;

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
        if (isset($_POST['submit'])) {
            $productName = htmlspecialchars(trim($_POST['productName']));
            $categoryId = htmlspecialchars(trim($_POST['categoryId']));
            $price = htmlspecialchars(trim($_POST['price']));
            $quantity = htmlspecialchars(trim($_POST['quantity']));
        }

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

        View::render('product.product', ['product' => $product, 'category' => $category]);
    }

    public function showAll()
    {
        $products = $this->modelProduct->getProducts();
        $categories = $this->modelCategory->getCategories();

        View::render('product.products', ['products' => $products, 'categories' => $categories]);
    }

    public function changeCategory()
    {
        if (isset($_POST['submit'])) {
            $productId = htmlspecialchars(trim($_POST['productId']));
            $categoryId = htmlspecialchars(trim($_POST['categoryId']));
        }

        $this->modelProduct->changeCategory($productId, $categoryId);
    }
}
