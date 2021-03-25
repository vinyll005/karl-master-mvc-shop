<?php

class HomeController
{
    public function ActionIndex()
    {
        // unset($_SESSION);
        // User::createUserName();
        $_SESSION['uri'] = $_SERVER['REQUEST_URI'];
        // print_r($_POST);
        // print_r($_SESSION['is_admin']);

        include_once(ROOT.'/views/home/index.php');
    }

    public function ActionTest()
    {
        User::addUserToDb('Kirill','levkir@yandex.ru', '1234321');
    }

    public function ActionRegister()
    {
        // echo 'We are atr home - register!';
        User::addUserToDb($_SESSION['user']['name'], $_SESSION['user']['email'], $_SESSION['user']['password']);

        header('Location:'.$_SESSION['uri']);
    }

    public function ActionLogin()
    {
        User::getUserInfo($_SESSION['user']['email']);
        // print_r($name);
        // $_SESSION['user']['name'] = $name;
        // print_r($_SERVER['REQUEST_URI']);

        header('Location:'.$_SESSION['uri']);
    }

    public function ActionExit()
    {
        unset($_SESSION['user']);

        header('Location:'.$_SESSION['uri']);
    }
}