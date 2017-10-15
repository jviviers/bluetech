<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class Created for managing incidents table in blue db.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'VSQL.php';

class IncidentsDB {

    public function __construct() {     }

//insert new incident into incidents table 
    public function addIncident($id, $date, $description, $terminal, $client, $location, $technician, $department){
        $dbx = VSQL::getdbx();   
        $ID = $id; $Date = $date; $Description = $description; $Terminal = $terminal; $Client = $client; $Location = $location; $Technician = $technician; $Department = $department; $Status = "Open";
        $insert = 'INSERT INTO incidents (ID, Date, Description, Term, Client, Location, Tech, Department, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $ID);   $insertstate->bindValue(2, $Date); $insertstate->bindValue(3, $Description); $insertstate->bindValue(4, $Terminal);  $insertstate->bindValue(5, $Client);   $insertstate->bindValue(6, $Location); $insertstate->bindValue(7, $Technician);   $insertstate->bindValue(8, $Department); $insertstate->bindValue(9, $Status);
        $insertstate->execute();   $insertstate->closeCursor();
    }
//update existing incident in incidents table specified by ID property
    public function updateIncident($previd, $id, $date, $description, $terminal, $client, $location, $technician, $department, $status){
        $dbx = VSQL::getdbx();  
        $prevID = $previd; $ID = $id; $Date = $date; $Description = $description; $Terminal = $terminal; $Client = $client; $Location = $location; $Technician = $technician; $Department = $department; $Status = $status;
        $update = 'UPDATE incidents SET ID = ?, Date = ?, Description = ?, Term = ?, Client = ?, Location = ?, Tech = ?, Department = ?, Status = ? WHERE ID = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $ID);   $updatestate->bindValue(2, $Date);   $updatestate->bindValue(3, $Description);  $updatestate->bindValue(4, $Terminal); $updatestate->bindValue(5, $Client);   $updatestate->bindValue(6, $Location); $updatestate->bindValue(7, $Technician); $updatestate->bindValue(8, $Department); $updatestate->bindValue(9, $Status); $updatestate->bindValue(10, $prevID);
        $updatestate->execute();   $updatestate->closeCursor();
    }
//get incident from incident table specified by ID property
    public function getIncident($id){
        $dbx = VSQL::getdbx();   
        $ID = $id;
        $selectTasks = 'SELECT * FROM incidents WHERE ID = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $ID);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//Get all incidents with status open or onhold from incidents table
    public function getAllActiveIncidents($department){
        $dbx = VSQL::getdbx();
        $Department = $department; $Status = "Open"; $Status2 = "OnHold";
        $selectTasks = 'SELECT * FROM incidents WHERE Department = ? AND Status = ? OR Department = ? AND Status = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Department); $state->bindValue(2, $Status); $state->bindValue(3, $Department); $state->bindValue(4, $Status2);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//delete incident from incidents table specified by ID property
    public function deleteIncident($id){
        $dbx = VSQL::getdbx();   
        $itemDel = $id;
        $deleteDB = 'DELETE FROM incidents WHERE ID = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
    //Get all incidents with status open or onhold from incidents table
    public function getReferredIncidents($department){
        $dbx = VSQL::getdbx();
        $Department = $department; $Status = "Referred";
        $selectTasks = 'SELECT * FROM incidents WHERE Department = ? AND Status = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Department); $state->bindValue(2, $Status);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    //Get all incidents with status open or onhold from incidents table
    public function getClientActiveIncidents($client, $tech){
        $dbx = VSQL::getdbx(); 
        $Client = $client; $Status = "Open"; $Status2 = "OnHold"; $Tech = $tech;
        $selectTasks = 'SELECT * FROM incidents WHERE Client = ? AND Status = ? AND Tech = ? OR Client = ? AND Status = ? AND Tech = ? ';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Client); $state->bindValue(2, $Status); $state->bindValue(3, $Tech); $state->bindValue(4, $Client); $state->bindValue(5, $Status2); $state->bindValue(6, $Tech);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
}

