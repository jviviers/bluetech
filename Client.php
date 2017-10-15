<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class created for management of a client instance.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include 'ClientDB.php';
class Client {
//Client properties   
    Private $ID;
    Private $Name;
    Private $Phone;
    Private $Email1;
    Private $Email2;
    Private $Department;
//Constructing new client class   
      public function __construct($ID, $ClientName, $Phone, $Email1, $Email2, $Department){
        $this->Name = $ClientName;
        $this->Phone = $Phone;
        $this->Email1 = $Email1;
        $this->Email2 = $Email2;
        $this->ID = $ID;
        $this->Department = $Department;
    }
//Set properties of client class using client ID
     public function setClientProperties($ID){
        $db = new ClientDB();
        $clientDetails = $db->getClient($ID);
        foreach ($clientDetails as $Client):
            $this->ID = $Client['ID'];
            $this->Name =$Client['Name'];
            $this->Email1 = $Client['Email1'];
            $this->Email2 = $Client['Email2'];
            $this->Phone = $Client['Phone'];
            $this->Department = $Client['Department'];
        endforeach;
    }
//Get and set client properties
    public function getName(){return $this->Name;}
    public function setName($ClientName){$this->Name = $ClientName;}
    public function getEmail1(){return $this->Email1;}
    public function setEmail1($Email1){$this->Email1 = $Email1;}
    public function getEmail2(){return $this->Email2;}
    public function setEmail2($Email2){$this->Email2 = $Email2;}
    public function getID(){return $this->ID;}
    public function setID($ID){$this->ID = $ID;}
    public function getPhone(){return $this->Phone;}
    public function setPhone($Phone){$this->Phone = $Phone;}
    public function getDepartment(){return $this->Department;}
    public function setDepartment($Department){$this->Department = $Department;}
//Save client instance when properties are set        
    public function saveClient(){
        $db = new ClientDB();
        $db->addClient($this->ID, $this->Name, $this->Phone, $this->Email1, $this->Email2, $this->Department);
    }
//Save client  instance when edited where previous id is known
    public function editClient($prevID){
        $db = new ClientDB();
        $db->editClient($prevID, $this->ID, $this->Name, $this->Phone, $this->Email1, $this->Email2, $this->Department);
    }
//Delete client identified by id property set for client instance
    public function deleteClient(){
        $db = new ClientDB();
        $db->deleteClient($this->ID);
    }
}
