<?php
  namespace blog\application\controllers;
  use blog\application\core\controller_core;

  class index_controller extends controller_core
  {

    function action_index()
    {
      $this->view->generate_page_view('index_view.php', 'basic_template.php');
    }

  }

?>
