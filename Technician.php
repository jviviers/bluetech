<?php
include 'TechnicianDB.php';

class Technician {
    
    Private $Name;
    Private $Surname;
    Private $Phone;
    Private $Email;
    Private $ID;
    
    
    public function __construct($ID, $Name, $Surname, $Phone,$Email){ 
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->Phone = $Phone;
        $this->Email = $Email;
    }
    public function setTechnician($ID){
        $db = new TechnicianDB();
        $Tech = $db->getTechDb($ID);
         foreach ($Tech as $detail):
            $this->ID = $detail['ID'];
            $this->Name =$detail['Name'];
            $this->Surname = $detail['Surname']; 
            $this->Phone = $detail['Phone'];
            $this->Email = $detail['Email'];
        endforeach;
    } 
    public function getTechID(){return $this->ID;}
    public function setTechID($ID){$this->ID = $ID;}
    public function getName(){return $this->Name;}
    public function setName($Name){$this->Name = $Name;}
    public function getSurname(){return $this->Surname;}
    public function setSurname($Surname){$this->Surname = $Surname;}
    public function getPhone(){return $this->Phone;}
    public function setPhone($Phone){$this->Phone = $Phone;}
    public function getEmail(){return $this->Email;}
    public function setEmail($Email){$this->Email = $Email;}
    
    public function getFullName(){
        $fullname = $this->Name.' '.$this->Surname;
        return $fullname;
    }
    public function saveTechnician(){
        $db = new TechnicianDB();
        $db->addTech($this->ID, $this->Name, $this->Surname, $this->Email, $this->Phone);
    }
    public function updateTechnician($PrevID){
        $db = new TechnicianDB();
        $db->editTech($PrevID, $this->ID, $this->Name, $this->Surname, $this->Email, $this->Phone);
    }
    public function delTechnician(){
        $db = new TechnicianDB();
        $db->deleteTech($this->ID);
    }
}
