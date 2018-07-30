<?php

  require_once 'vendor/autoload.php';

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  $route = new blog\application\route();
  $route->start();

?>
