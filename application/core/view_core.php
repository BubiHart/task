<?php
  namespace blog\application\core;

  class view_core
  {


    function generate_page_view($content_view, $basic_template)
    {
      include './application/views/'.$basic_template;
      include './application/views/'.$content_view;
    }

  }


?>
