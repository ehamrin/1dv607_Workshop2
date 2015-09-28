<?php


namespace model\dal;


class DatabaseConnection
{
    private static $Dsn = 'localhost';
    private static $Database = 'Workshop';
    private static $User = 'AppUser';
    private static $Password = 'PL6DvzxEqyxqFERK';

    public function Establish(){
        return new \PDO('mysql:host=' . self::$Dsn . ';dbname=' . self::$Database . ';', self::$User, self::$Password, array(\PDO::FETCH_OBJ));
    }
}