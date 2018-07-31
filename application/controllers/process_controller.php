<?php
  namespace blog\application\controllers;
  use blog\application\core\controller_core;
  session_start();

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

       if(isset($_POST['new_login']) && isset($_POST['old_password']) && isset($_POST['new_password']))
       {
           $this->model->change_user_data();
       }

       if(isset($_POST['log_out']))
       {
           //unset($_SESSION['login']);
           session_destroy();
           /*
           $index_view = new index_controller();
           $index_view->action_index();
           */
       }
    }

  }

?>
