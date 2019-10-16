<?php

namespace Src\Interfaces;

interface Category {
  public function add();
  public function show($id);
  public function showAll();
}