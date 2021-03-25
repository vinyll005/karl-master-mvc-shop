<?php

class Db
{

    public static function getDbConn()
    {
        // $params = include_once(ROOT.'/config/db_params.php');

        $db = mysqli_connect('localhost', 'root', 'root', 'karl_shop');

        return $db;
    }
}