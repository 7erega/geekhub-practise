<?php

namespace Src\Interfaces;

interface Product {
  public function add();
  public function show($productId);
  public function showAll();
  public function changeCategory();
}