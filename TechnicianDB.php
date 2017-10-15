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

class TechnicianDB {

    public function __construct() {     }

    //Table Technicians
    public function getTechDb($Code){
        $dbx = VSQL::getdbx();   
        $code = $Code;
        $selectTasks = 'SELECT * FROM technicians WHERE ID = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $code);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function addTech($code,$name,$surname,$email,$cell){
        $dbx = VSQL::getdbx();   
        $Code = $code;   $Name = $name;   $Surname = $surname;   $Email = $email;   $Cell = $cell;
        $insert = 'INSERT INTO technicians (ID, Name, Surname, Email, Phone) VALUES (?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $Code);   $insertstate->bindValue(2, $Name);   $insertstate->bindValue(3, $Surname); $insertstate->bindValue(4, $Email);   $insertstate->bindValue(5, $Cell);
        $insertstate->execute();   $insertstate->closeCursor();
    }
    public function deleteTech($deleteCode){
        $dbx = VSQL::getdbx();   
        $itemDel = $deleteCode;
        $deleteDB = 'DELETE FROM technicians WHERE ID = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }       
    Public function editTech ($empCode,$editcode,$name,$surname,$email,$cell){
        $dbx = VSQL::getdbx();
        $Oldcode = $empCode;   $Newcode = $editcode;   $Name = $name;   $Surname = $surname;   $Mail = $email;   $Cell = $cell;
        $update = 'UPDATE technicians SET ID = ?, Name = ?, Surname = ?, Email = ?, Phone = ? WHERE ID = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $Newcode);   $updatestate->bindValue(2, $Name);   $updatestate->bindValue(3, $Surname); $updatestate->bindValue(4, $Mail);   $updatestate->bindValue(5, $Cell);   $updatestate->bindValue(6, $Oldcode);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function getAllTechs(){
        $dbx = VSQL::getdbx();
        $selectTasks = 'SELECT * FROM technicians';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    
}