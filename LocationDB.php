<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class created for management of locations table in blue database (SQL statements).
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'VSQL.php';

class LocationDB {

    public function __construct() {     }

//inert new location into table 
    public function addLocation($city, $region){
        $dbx = VSQL::getdbx();   
        $City = $city;   $Region = $region;
        $insert = 'INSERT INTO locations (City, Region) VALUES (?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $City);   $insertstate->bindValue(2, $Region);
        $insertstate->execute();   $insertstate->closeCursor();
    }
//updates location instance properties in table specified by City property
    public function editLocation($oldcity, $city, $region){
        $dbx = VSQL::getdbx();
        $OldCity = $oldcity;   $City = $city;   $Region = $region;    
        $update = 'UPDATE locations SET City = ?, Region = ? WHERE City = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $City);   $updatestate->bindValue(2, $Region);   $updatestate->bindValue(3, $OldCity);
        $updatestate->execute();   $updatestate->closeCursor();
    }
//get all locations in table
    public function getAllLocations(){
        $dbx = VSQL::getdbx();
        $selectTasks = 'SELECT * FROM locations';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//Delete location from table where City is known
    public function deleteLocation($city){
        $dbx = VSQL::getdbx();   
        $City = $city;
        $deleteDB = 'DELETE FROM locations WHERE City = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$City);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
//gets location properties when City property is known
    public function getLocation($city){
        $dbx = VSQL::getdbx(); 
        $City =$city;
        $selectTasks = 'SELECT * FROM locations WHERE City = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $City);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
}
