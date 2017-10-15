<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class created for management of a department instance.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include_once 'DepartmentsDB.php';

class Department {
//department class properties    
    Private $Name;
    Private $Email1;
    Private $Email2;
    Private $Email3;    
//constructing a department instance    
    public function __construct($Name, $Email1, $Email2, $Email3){
        $this->Name = $Name;
        $this->Email1 = $Email1;
        $this->Email2 = $Email2;
        $this->Email3 = $Email3;
    }
//sets department properties when department name is known
    public function setDepartment($Name){
        $db = new DepartmentsDB();
        $Depart = $db->getDepartmentDB($Name);
         foreach ($Depart as $detail):
            $this->Name =$detail['Name'];
            $this->Email1 = $detail['Email1']; 
            $this->Email2 = $detail['Email2'];
            $this->Email3 = $detail['Email3'];
        endforeach;
    }
//sets and gets department properties when set
    public function getName(){return $this->Name;}
    public function setName($Name){$this->Name = $Name;}
    public function getEmail1(){return $this->Email1;}
    public function setEmail1($Email1){$this->Email1 = $Email1;}
    public function getEmail2(){return $this->Email2;}
    public function setEmail2($Email2){$this->Email2 = $Email2;}
    public function getEmail3(){return $this->Email3;}
    public function setEmail3($Email3){$this->Email3 = $Email3;}
//save new department to departments tabe in blue db    
    public function saveDepartment(){
        $db = new DepartmentsDB();
        $db->addDepartment($this->Name, $this->Email1, $this->Email2, $this->Email3);
    }
//updates department properties to blue db
    public function updateDepartment($PrevName){
        $db = new DepartmentsDB();
        $db->editDepartment($PrevName, $this->Name, $this->Email1, $this->Email2, $this->Email3);
    }
//deletes department from department table in blue db
    public function delDepartment(){
        $db = new DepartmentsDB();
        $db->deleteDepartment($this->Name);
    }
}


