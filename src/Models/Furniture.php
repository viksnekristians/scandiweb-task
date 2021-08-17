<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Product;

class Furniture extends Product {

  public function category() 
  {
      return Furniture::class;
  }
  public function property()
  {
      return 'Dimensions';
  }

}