<?php
  namespace blog\application\controllers;
  use blog\application\core\controller_core;

  class process_controller extends controller_core
  {

    function action_process()
    {
       if(isset($_POST['registration_login']) && isset($_POST['registration_password']))
       {
           $this->model->register();
       }

       if(isset($_POST['login_login']) && isset($_POST['login_password']))
       {
           $this->model->login();
       }

    }

  }

?>
