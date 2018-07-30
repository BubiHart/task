<?php
namespace blog\application\controllers;
use blog\application\core\controller_core;

class registration_controller extends controller_core
{

function action_registration()
{
    $this->view->generate_page_view('registration_view.php', 'basic_template.php');
}

}

?>
