<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class created for management of a clients table in blue database.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'VSQL.php';

class ClientDB {
    
    public function __construct() {     }
//function to add new client to client table 
    public function addClient($name, $phone, $email1, $email2, $department){
        $dbx = VSQL::getdbx();  
        $Name = $name;   $Email1 = $email1; $Email2 = $email2; $Phone = $phone; $Department = $department;
        $insert = 'INSERT INTO clients (Name, Phone, Email1, Email2, Department) VALUES (?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $Name);   $insertstate->bindValue(2, $Phone);  $insertstate->bindValue(3, $Email1);   $insertstate->bindValue(4, $Email2);   $insertstate->bindValue(5, $Department);
        $insertstate->execute();   $insertstate->closeCursor();
    }
//function to edit specified client row in the clients table
    public function editClient($oldid, $id, $name, $phone, $email1, $email2, $department){
        $dbx = VSQL::getdbx();  
        $OldID = $oldid;   $ID = $id;   $Name = $name;   $Phone = $phone; $Email1 = $email1; $Email2 = $email2;  $Department = $department; 
        $update = 'UPDATE clients SET ID = ?, Name = ?, Phone = ?, Email1 = ?, Email2 = ?, Department = ? WHERE ID = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $ID);   $updatestate->bindValue(2, $Name);   $updatestate->bindValue(3, $Phone); $updatestate->bindValue(4, $Email1); $updatestate->bindValue(5, $Email2);   $updatestate->bindValue(6, $Department); $updatestate->bindValue(7, $OldID);
        $updatestate->execute();   $updatestate->closeCursor();
    }
//function to get client properties from clients table where id is known
    public function getClient($id){
        $dbx = VSQL::getdbx();     
        $ID = $id;
        $selectTasks = 'SELECT * FROM clients WHERE ID = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $ID);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//function to get all clients from clients table
    public function getAllClients(){
        $dbx = VSQL::getdbx(); 
        $selectTasks = 'SELECT * FROM clients';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//function to delete client from clients table specified by client's id
    public function deleteClient($id){
        $dbx = VSQL::getdbx();     
        $itemDel = $id;
        $deleteDB = 'DELETE FROM clients WHERE ID = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
//function gets all clients in retail department
    public function getDepartmentClients($department){
        $Department = $department;
        $dbx = VSQL::getdbx();  
        $selectTasks = 'SELECT * FROM clients WHERE Department = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1,$Department);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//function gets client's id where client's name is known
    public function getClientID($name){
        $dbx = VSQL::getdbx();     
        $Name = $name;
        $selectTasks = 'SELECT * FROM clients WHERE Name = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Name);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
}
