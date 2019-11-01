<?php

foreach ($data['categories'] as $categoryId => $categoryName) {
    echo $categoryName . "<br>";
    foreach ($data['products'] as $product) {
        if ($product['category_id'] == $categoryId) {
            echo "<br>Product name: " . $product['name'] . "<br>Price: " . $product['price'] . "<br>Quantity: " . $product['quantity'] . "<br>";
        }
    }
    echo "<br>";
}

echo "<br>";