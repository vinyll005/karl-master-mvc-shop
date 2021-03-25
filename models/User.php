<?php

class User
{


    public static function addUserToDb($name, $email, $password)
    {
        $db = Db::getDbConn();

        $name = urldecode(htmlspecialchars(trim($name)));
        $email = urldecode(htmlspecialchars(trim($email)));
        $password = urldecode(htmlspecialchars(trim($password)));

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $request = $db->prepare('INSERT INTO users(name, email, password) VALUES (?, ?, ?)');
        $request->bind_param('sss', $name, $email, $passwordHash);
        $request->execute();

        // echo 'User saved!';
        return true;
    }

    public static function checkErrorsLogin($email, $password)
    {
        $email = urldecode(htmlspecialchars(trim($email)));
        $password = urldecode(htmlspecialchars(trim($password)));
        unset($_SESSION['errors']);

        if(empty($email))  {
            $_SESSION['errors']['email'] = 'Field with email is empty!';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'It\'s not a email!';
        }  elseif(!(User::checkEmailExists($email)))  {
            $_SESSION['errors']['email'] = 'Invalid email!';
        }  
        if(empty($password))   {
            $_SESSION['errors']['password'] = 'Field with password is empty!';
        }   elseif(strlen($password) <= 6)  {
            $_SESSION['errors']['password'] = 'Password too short!';
        }   elseif(!(User::checkPassword($email, $password)))    {
            $_SESSION['errors']['password'] = 'Wrong password!';
        }

        if(!empty($_SESSION['errors'])) {
            echo json_encode($_SESSION['errors']);
        }   else {
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['password'] = $password;
            echo json_encode(array('success' => 1));
        }
        
    }

    public static function checkErrorsRegister($name, $email, $password)
    {
        $email = urldecode(htmlspecialchars(trim($email)));
        $password = urldecode(htmlspecialchars(trim($password)));
        $name = urldecode(htmlspecialchars(trim($name)));
        unset($_SESSION['errors']);

        if(empty($email))  {
            $_SESSION['errors']['email'] = 'Field with email is empty!';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'It\'s not a email!';
        }   elseif(User::checkEmailExists($email))  {
            $_SESSION['errors']['email'] = 'This email already existed!';
        }  
        if(empty($password))   {
            $_SESSION['errors']['password'] = 'Field with password is empty!';
        }   elseif(strlen($password) <= 6)  {
            $_SESSION['errors']['password'] = 'Password too short!';
        }

        if(!empty($_SESSION['errors'])) {
            echo json_encode($_SESSION['errors']);
        }   else {
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['password'] = $password;
            echo json_encode(array('success' => 1));
        }
        
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("SELECT * FROM users WHERE email = ?");
        $request->bind_param('s', $email);
        $request->execute();
        $result = $request->get_result();
        // print_r($result);

        if($result->fetch_assoc())   {
            return true;
        }
        return false;
    }

    public static function checkPassword($email, $password)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("SELECT * FROM users WHERE email = ?");
        $request->bind_param('s', $email);
        $request->execute();
        $result = $request->get_result();

        $row = $result->fetch_assoc();
        return password_verify($password, $row['password']);
    }

    public static function getUserInfo($email)
    {
        $db = Db::getDbConn();

        $request = $db->prepare("SELECT * FROM users WHERE email = ?");
        $request->bind_param('s', $email);
        $request->execute();

        $result = $request->get_result();
        $row = $result->fetch_assoc();
        // print_r($row);
        $_SESSION['user']['name'] = $row['name'];
        $_SESSION['user']['is_admin'] = $row['is_admin'];
    }

    public static function createUserName()
    {
        $db = Db::getDbConn();

        $request = $db->query("SELECT * FROM users ORDER BY id desc LIMIT 1");

        $row = $request->fetch_assoc();
        return 'user'.strval($row['id']+1);
    }

}