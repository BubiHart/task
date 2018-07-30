<?php
  namespace blog\application\core;

  class controller_core
  {
    public $view;
    public $model;

    function __construct()
    {
      $this->view = new view_core();
      $this->model = new model_core();
    }

  }


?>
