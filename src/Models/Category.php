<?php

namespace Src\Models;

class Category
{
    private $fileContent;
    private $id;
    private $name;

    public function __construct()
    {
        $file = file_get_contents(__DIR__ . '/../../data/database.json');
        $this->fileContent = json_decode($file, true);
        unset($file);
    }

    public function getCategories()
    {
        $categoriesList = array();

        foreach ($this->fileContent['categories'] as $category) {
            $categoryId = array_shift($category);
            $categoriesList[$categoryId] = $category['name'];
        }

        return $categoriesList;
    }

    public function getCategoryName($id)
    {
        $categoriesList = $this->getCategories();

        return $categoriesList[$id];
    }
}
