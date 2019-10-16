<?php

namespace Src\Models;

class Product {

  static function getProduct($id) {
    require_once __DIR__ . "/../../data/database.json";
  }
}