<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class created for connecting to blue db and manage departments table (sql statements)
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'VSQL.php';

class DepartmentsDB {

    public function __construct() {     }

//Gets department properties when department name is known
    public function getDepartmentDB($Name){
        $dbx = VSQL::getdbx();    
        $name = $Name;
        $selectTasks = 'SELECT * FROM departments WHERE Name = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $name);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
//add new department to departments table
    public function addDepartment($name,$email1,$email2,$email3){
        $dbx = VSQL::getdbx();    
        $Name = $name;   $Email1 = $email1;   $Email2 = $email2;   $Email3 = $email3;
        $insert = 'INSERT INTO departments (Name, Email1, Email2, Email3) VALUES (?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $Name);   $insertstate->bindValue(2, $Email1); $insertstate->bindValue(3, $Email2);   $insertstate->bindValue(4, $Email3);
        $insertstate->execute();   $insertstate->closeCursor();
    }
//deletes department instance from table where name is known
    public function deleteDepartment($name){
        $dbx = VSQL::getdbx();    
        $itemDel = $name;
        $deleteDB = 'DELETE FROM departments WHERE Name = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
//updates department properties to table specified by department name
    Public function editDepartment ($prename,$name,$email1,$email2,$email3){
        $dbx = VSQL::getdbx();
        $Oldname = $prename;   $Name = $name;   $Email1 = $email1;   $Email2 = $email2;   $Email3 = $email3;
        $update = 'UPDATE departments SET Name = ?, Email1 = ?, Email2 = ?, Email3 = ? WHERE Name = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $Name);   $updatestate->bindValue(2, $Email1);   $updatestate->bindValue(3, $Email2); $updatestate->bindValue(4, $Email3);   $updatestate->bindValue(5, $Oldname);
        $updatestate->execute();   $updatestate->closeCursor();
    }
//gets all departments from table
    public function getAllDepartments(){
        $dbx = VSQL::getdbx(); 
        $selectTasks = 'SELECT * FROM departments';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    } 
}

