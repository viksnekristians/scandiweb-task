<?php

declare(strict_types=1);

namespace App\Models;

use App\db\Database;
use PDO;


abstract class Product extends Database {

  protected static $table = 'products';
  protected $fields= ['category', 'sku', 'name', 'price', 'property', 'property_value'];
  /*
  public $sku = 'default';
  public $name= 'default';
  public $price= 0;
  public $property_value='d';
*/
  public $sku;
  public $name;
  public $price;
  public $property_value;
  public abstract function category();
  public abstract function property();

  public function setParameters($sku= 'default', $name= 'default', $price=9, $property_value= 'default')
  {
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
    $this->property_value = $property_value;
  }

  public function fieldValues() 
  {
    return array($this->category(), $this->sku, $this->name, $this->price, $this->property(), $this->property_value);
  }

  public function saveProduct() 
  {
      $columns = implode(',', $this->fields);
      $values='';
      for($i=0; $i<count($this->fields); $i++)  {
        $values .= '?,';
      }
      $values =  rtrim($values, ',');
      $sql = "insert into ".self::$table."(".$columns.") 
      values (".$values.");";
      $stmt = $this->connect()->prepare($sql);
      if($stmt->execute($this->fieldValues())) return true; else return false;
  }



  public static function getProducts()
  {
    $sql = "select category, id, sku, name, price, property, property_value from ".self::$table." order by id asc;";
    $stmt = self::connect()->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE); 
    echo json_encode($results);
    
    
  }

  public static function deleteProducts($ids)
  {
    $idsStr = implode($ids, ',');
    $sql="delete from ".self::$table." where id in (".$idsStr.");";
    $stmt = self::connect()->prepare($sql);
    $stmt->execute();
  }



}
