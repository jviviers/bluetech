<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientDB
 *
 * @author Jacques
 */
include_once 'VSQL.php';

class TerminalDB {

    public function __construct() {     }
 
public function addTerminal($ID, $name, $serial, $location, $client, $department){
        $dbx = VSQL::getdbx();   
        $Id = $ID; $Name = $name;   $Serial = $serial; $Location = $location; $Client = $client; $Department = $department;
        $insert = 'INSERT INTO terminals (ID, Name, Serial, Location, Client, Department) VALUES (?, ?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $Id);   $insertstate->bindValue(2, $Name); $insertstate->bindValue(3, $Serial);   $insertstate->bindValue(4, $Location);   $insertstate->bindValue(5, $Client); $insertstate->bindValue(6, $Department);
        $insertstate->execute();   $insertstate->closeCursor();
    }
    public function editTerminal($oldid, $id, $name, $serial, $location, $client, $department){
        $dbx = VSQL::getdbx();
        $OldID = $oldid;   $ID = $id;   $Name = $name;   $Serial = $serial; $Location = $location; $Client = $client; $Department = $department;
        $update = 'UPDATE terminals SET ID = ?, Name = ?, Serial = ?, Location = ?, Client = ?, Department = ? WHERE ID = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $ID);   $updatestate->bindValue(2, $Name);   $updatestate->bindValue(3, $Serial); $updatestate->bindValue(4, $Location); $updatestate->bindValue(5, $Client);   $updatestate->bindValue(6, $Department); $updatestate->bindValue(7, $OldID);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function getTerminal($id, $site){
        $dbx = VSQL::getdbx();   
        $ID = $id; $Site = $site;
        $selectTasks = 'SELECT * FROM terminals WHERE ID = ? AND Name = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $ID); $state->bindValue(2, $Site);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getAllTerminals(){
        $dbx = VSQL::getdbx();
        $selectTasks = 'SELECT * FROM terminals';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function deleteTerminal($id){
        $dbx = VSQL::getdbx();   
        $itemDel = $id;
        $deleteDB = 'DELETE FROM terminals WHERE ID = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
    public function getClientTerminals($client){
        $dbx = VSQL::getdbx();   
        $Client = $client;
        $selectTasks = 'SELECT * FROM terminals WHERE Client = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Client);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
}

