<?php
  namespace blog\application\core;
  use MongoDB;





  class model_core
  {


    /*CONNECT TO MongoDB*/
    function database_connect()
    {
        $uri = "mongodb://root:tgEm8ZObfIpzXY2bNBSl@ds159121.mlab.com:59121/task";
        $options = array("connectTimeoutMS" => 30000);
        $client = new MongoDB\Client($uri, $options);

        return $client;

    }

    /*HASH PASSWORD USING NEWEST OPTIONS*/
    function hash_password($password)
    {
      $password = (string) password_hash($password, PASSWORD_DEFAULT);

      return $password;
    }

    /*REGISTER NEW USER*/
    function register()
    {

        /*CONNECT TO DB AND CHOOSE COLLECTION*/
        $client = $this->database_connect();
        $collection = $client->selectCollection('task', 'users');


        /*PUTTING POST DATA INTO VARIABLES*/
        $login = (string) $_POST['registration_login'];
        $login = trim($login);

        $password = (string) $_POST['registration_password'];
        $password = trim($password);

        /*HASHING PASSWORD*/
        $user_password_hash = (string) $this->hash_password($password);

        $data = array('login' => $login, 'password' => $user_password_hash);
        $collection->insertOne($data);

    }

    /*LOGIN*/
    function login()
    {
        $message = array();
        $client = $this->database_connect();
        $collection =  $client->selectCollection('task', 'users');


        $login = (string) $_POST['login_login'];
        $login = trim($login);

        $password = (string) $_POST['login_password'];
        $password = trim($password);

        $user = $collection->findOne(array('login' => $login));

        if(password_verify($password, $user['password']))
        {
            session_start();
            $_SESSION['login'] = $login;
            $message['login_success'] = 'success';
        }
        else
        {
            $message['login_success'] = 'password is incorrect';
        }

        if(!empty($message))
        {
            echo json_encode($message);
        }

    }

    function get_all_users()
    {
      $client = $this->database_connect();
      $collection = $client->selectCollection('task', 'users');

        $cursor = $collection->find();
        foreach ($cursor as $doc)
        {
            var_dump($doc);
        }
    }



    }


?>
