<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;
session_start();

class user_controller extends controller_core
{

function action_user()
{
    if(isset($_SESSION['login']))
    {
        $this->view->generate_page_view('user_view.php', 'basic_template.php');
        $this->model->get_user_data();
    }
    else
    {
        $controller = new login_controller();
        $controller->action_login();
    }


}

}

?>
