<?php

declare(strict_types=1);

namespace App;

class View {
  private string $viewName;
  private array $data;


  public function render($viewName, $data=null) {
    $content = __DIR__.'/../resources/views/'.$viewName;
    include(__DIR__.'/../resources/layouts/main.php');
    //include(__DIR__.'/../resources/views/'.$viewName);
  }

  public function redirect($viewName, $data=null) {
    $host = $_SERVER['HTTP_HOST'];
    header("Location: http://".$host."/".$viewName);
  }
}
