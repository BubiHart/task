<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;

class user_controller extends controller_core
{

function action_user()
{
    $this->view->generate_page_view('user_view.php', 'basic_template.php');
}

}

?>
