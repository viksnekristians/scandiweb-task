<?php
namespace App\Controllers;

use App\View;
use App\Session;
use App\Models\Product;

class ProductController {

  public function show() 
  {
    $view = new View();
    $view->render('show.php', []);
  }

  public function getProducts()
  {
    Product::getProducts();
  }

  public function add() 
  {
    $view = new View();
    $view->render('add.php', []);
  }

  public function addProduct()
  {
    $category = $_POST['category'];
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $property = $_POST['property'];
    $propertyValue = $_POST['propertyValue'];

    $classname="App\\Models\\".$category;

    $obj = new $classname;
    $obj->setParameters($sku, $name, $price, $propertyValue);
    $obj->saveProduct();
    
    
    
  }

  public function deleteProducts()
  {
    if (isset($_POST['delete-btn']))
    {
      $ids =$_POST['delete-checkbox'];
      Product::deleteProducts($ids);
    }
    $view = new View();
    $view->render('show.php', []);
    
  }

  
}
