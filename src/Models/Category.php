<?php

namespace Src\Models;

class Category {

  static function getCategories() {
    $file = file_get_contents(__DIR__ . '/../../data/database.json');
    $array = json_decode($file, TRUE);
    unset($file);

    $categoriesList = array();

    foreach ($array['categories'] as $category) {
      $categoryId = array_shift($category);
      $categoriesList[$categoryId] = $category['name'];
    }

    return $categoriesList;
  }

  static function getCategoryName($id) {
    $categoriesList = self::getCategories();

    return $categoriesList[$id];
  }
}