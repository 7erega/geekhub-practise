<?php

namespace Src\Interfaces;

interface Product {
  public function create();
  public function show($productId);
  public function showAll();
  public function changeCategory();
}