<?php
include 'TerminalDB.php';

class Terminal {
    
    Private $ID;
    Private $Name;
    Private $Serial;
    Private $Location;
    Private $Client;
    Private $Department;
    
      public function __construct($ID, $Name, $Serial, $Location, $Client, $Department){
        $this->Name = $Name;
        $this->Serial = $Serial;
        $this->Location = $Location;
        $this->Client = $Client;
        $this->ID = $ID;
        $this->Department = $Department;
    }
     public function setTerminalProperties($ID, $Site){
        $db = new TerminalDB();
        $terminalDetails = $db->getterminal($ID, $Site);
        foreach ($terminalDetails as $term):
            $this->ID = $term['ID'];
            $this->Name =$term['Name'];
            $this->Serial = $term['Serial'];
            $this->Location = $term['Location'];
            $this->Client = $term['Client'];
            $this->Department = $term['Department'];
        endforeach;
    }
    public function getName(){return $this->Name;}
    public function setName($ClientName){$this->Name = $ClientName;}
    public function getSerial(){return $this->Serial;}
    public function setSerial($Serial){$this->Serial = $Serial;}
    public function getLocation(){return $this->Location;}
    public function setLocation($Location){$this->Location = $Location;}
    public function getID(){return $this->ID;}
    public function setID($ID){$this->ID = $ID;}
    public function getClient(){return $this->Client;}
    public function setClient($Client){$this->Client = $Client;}
    public function getDepartment(){return $this->Department;}
    public function setDepartment($Department){$this->Department = $Department;}
        
    public function saveTerminal(){
        $db = new TerminalDB();
        $db->addTerminal($this->ID, $this->Name, $this->Serial, $this->Location, $this->Client, $this->Department);
    }
    public function editTerminal($prevID){
        $db = new TerminalDB();
        $db->editTerminal($prevID, $this->ID, $this->Name, $this->Serial, $this->Location, $this->Client, $this->Department);
    }
    public function deleteTerminal(){
        $db = new TerminalDB();
        $db->deleteTerminal($this->ID);
    }
}
