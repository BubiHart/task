<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;

class home_controller extends controller_core
{

function action_home()
{
    $this->view->generate_page_view('home_view.php', 'basic_template.php');
}

}

?>
