<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;

class login_controller extends controller_core
{

function action_login()
{
    $this->view->generate_page_view('login_view.php', 'basic_template.php');

    //$this->model->database_connect();

}

}

?>
