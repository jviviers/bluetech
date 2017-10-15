<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class Created for parts table sql statements and connecting to blue Database.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'VSQL.php';

class PartsDB {

    public function __construct() {     }

//insert new instance of part into table 
    public function addPart($partnum, $description, $department){
        $dbx = VSQL::getdbx();   
        $PartNum = $partnum; $Description = $description;   $Department = $department;
        $insert = 'INSERT INTO parts (PartNum, Description, Department) VALUES (?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $PartNum);  $insertstate->bindValue(2, $Description); $insertstate->bindValue(3, $Department);
        $insertstate->execute();   $insertstate->closeCursor();
    }
//modify specified part instance in table
    public function editPart($oldpartnum, $partnum, $description, $department){
        $dbx = VSQL::getdbx();
        $OldNum = $oldpartnum;   $PartNum = $partnum; $Description = $description; $Department = $department;
        $update = 'UPDATE parts SET PartNum = ?, Description = ?,  Department = ? WHERE PartNum = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $PartNum);   $updatestate->bindValue(2, $Description);   $updatestate->bindValue(3, $Department); $updatestate->bindValue(4, $OldNum); 
        $updatestate->execute();   $updatestate->closeCursor();
    }
//get part description from table when part number is known
    public function getPartDesciption($partnum){
        $dbx = VSQL::getdbx();   
        $PartNum = $partnum;
        $selectTasks = 'SELECT * FROM parts WHERE PartNum = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $PartNum);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//retrieves all parts from table
    public function getAllParts(){
        $dbx = VSQL::getdbx();
        $selectTasks = 'SELECT * FROM parts';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//delete part from table where partnumber is known
    public function deletePart($partnum){
        $dbx = VSQL::getdbx();   
        $itemDel = $partnum;
        $deleteDB = 'DELETE FROM parts WHERE PartNum = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
//get partnumber when description is available
    public function getPartNum($description){
        $dbx = VSQL::getdbx();   
        $Description = $description;
        $selectTasks = 'SELECT * FROM parts WHERE Description = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Description);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }   
}
