<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Product;

class Book extends Product {

  public function category() 
  {
      return Book::class;
  }
  public function property()
  {
      return 'Weight';
  }

}