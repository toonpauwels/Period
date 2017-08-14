<?php
class Db {

    private static $conn = NULL;

    public static function getInstance(){

        if( isset( self::$conn )){
            //er is al connectie, geef die terug
            echo "er is al connectie";
            return self::$conn;
        }
        else {
            //er is nog geen conn, maak ze aan en geef terug
            self::$conn = new PDO("mysql:host=localhost; dbname=cars", "root", "" );
            echo "nieuwe conn aanmaken";
            return self::$conn;
        }

    }

}