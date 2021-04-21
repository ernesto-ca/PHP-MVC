<?php
class Connection
{
    public static function connect()
    {
        $link = new PDO("mysql:host=localhost;dbname=test", "root", null);
        //$link->("set names utf8");
        return $link;
    }
}
