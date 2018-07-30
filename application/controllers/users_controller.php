<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;

class users_controller extends controller_core
{

function action_users()
{
    $this->view->generate_page_view('users_view.php', 'basic_template.php');
    $this->model->get_all_users();
}

}

?>
