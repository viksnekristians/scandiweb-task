<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Product;

class DVD extends Product {

  public function category() 
  {
      return DVD::class;
  }
  public function property()
  {
      return 'Size';
  }

}