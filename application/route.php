<?php
  namespace blog\application;

  class route
  {

    function start()
    {
      $requested_uri = (string) $_SERVER['REQUEST_URI'];

      $get_param_clean = explode('?', $requested_uri);
      $get_param_clean = $get_param_clean[0];
      
      $routes = (array) explode('/', $get_param_clean);

      for ($i = 0; $i < count($routes); $i++)
      {
        if ($routes[2] == '')
        {
          $routes[2] = (string) "index";
        }
      }

      $page_name = (string) $routes[2];
      $controller_name = $page_name."_controller";
      $action_name = "action_".$page_name;
      $controller_class_name = __NAMESPACE__ . '\\controllers\\' . $controller_name;

      $controller = new $controller_class_name;
      $action = $action_name;

      if(method_exists($controller, $action))
      {
        $controller->$action();
      }
      else
      {
        $this->error404();
      }
    }

    function error404()
  	{
      $host = 'http://'.$_SERVER['HTTP_HOST'].'/';

      header('HTTP/1.1 404 Not Found');
  		header("Status: 404 Not Found");
  		header('Location:'.$host.'404');
    }

  }
