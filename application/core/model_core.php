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

        $user_existence = $this->check_uniqueness($login);

        if($user_existence === false)
        {
            $data = array('login' => $login, 'password' => $user_password_hash);
            $collection->insertOne($data);

            session_start();
            $_SESSION['login'] = $login;
        }

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

        $user_existence = $this->check_uniqueness($login);

        if(password_verify($password, $user['password']) && $user_existence === true)
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
        foreach ($cursor as $entry)
        {
            echo $entry['_id'], ': ', $entry['login'], ',   ', $entry['password'], "<br>";
        }
    }

    function get_user_data()
    {
        $client = $this->database_connect();
        $collection = $client->selectCollection('task', 'users');
        $user_data = $collection->findOne(array('login' => $_SESSION['login']));

        echo "<span>Your login: ".$user_data['login']."</span>";
        echo "<span>Change login</span>";
        echo "<input id='change_new_login' type='text'>";

        echo "<span>Change password</span>";
        echo "<span>Old password</span>";
        echo "<input id='change_old_password' type='text'>";
        echo "<span>New password</span>";
        echo "<input id='change_new_password' type='text'>";

        echo "<a id='change_submit' href='process'>Confirm changes</a>";
    }

    function change_user_data()
    {
        $client = $this->database_connect();
        $collection = $client->selectCollection('task', 'users');
        $user_data = $collection->findOne(array('login' => $_SESSION['login']));
        $user_password_hash = $user_data['password'];
        $user_login = $_SESSION['login'];


        $new_login = (string) $_POST['new_login'];
        $new_login = trim($new_login);

        $old_password = (string) $_POST['old_password'];
        $old_password = trim($old_password);

        $new_password = (string) $_POST['new_password'];
        $new_password = trim($new_password);


        if(!empty($new_login) && !empty($old_password) && !empty($new_password))
        {
            if(password_verify($old_password, $user_password_hash))
            {
                $new_password_hash = $this->hash_password($new_password);
                $collection->findOneAndReplace(array('login' => $_SESSION['login']), array('login' => $new_login, 'password' => $new_password_hash));
                session_start();
                $_SESSION['login'] = $new_login;
            }
        }

        if(!empty($new_login) && empty($old_password) && empty($new_password))
        {
            $collection->findOneAndReplace(array('login' => $_SESSION['login']), array('login' => $new_login, 'password' => $user_password_hash));
            session_start();
            $_SESSION['login'] = $new_login;
        }

        if(empty($new_login) && !empty($old_password) && !empty($new_password))
        {
            if(password_verify($old_password, $user_password_hash))
            {
                $new_password_hash = $this->hash_password($new_password);
                $collection->findOneAndReplace(array('login' => $_SESSION['login']), array('login' => $user_login,'password' => $new_password_hash));
                session_start();
                $_SESSION['login'] = $user_login;
            }
        }

        /*
        if(!empty($new_login))
        {
            $data = array('login' => $new_login);
            $collection->findOneAndReplace(array('login' => $_SESSION['login']), array('login' => $new_login));
            $collection->insertOne($data);
        }

        if(!empty($old_password) && !empty($new_password))
        {
        }
        */

    }

    function check_uniqueness($user_login)
    {
        $client = $this->database_connect();
        $collection = $client->selectCollection('task', 'users');

        $user_data = $collection->findOne(array('login' => $user_login));

        if(isset($user_data['login']))
        {
            $existence = (bool) true;
            return $existence;
        }
        else
        {
            $existence = (bool) false;
            return $existence;
        }
    }

    }


?>
