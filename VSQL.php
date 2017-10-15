<?php

class VSQL {

private static $dsn = 'mysql:host=localhost;dbname=blue'; private static $username = 'root'; private static $password = '';  private $dbx;
    public function __construct() {     }
    public function getdbx() {   
        try {$this->dbx = new PDO (self::$dsn, self::$username, self::$password);}
            catch (PDOException $ex) {echo "Sorry, cannot connect to Server".$ex;}        
        return $this->dbx;
    }
}

