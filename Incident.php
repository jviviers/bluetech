<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Class Created for managing incident instance and incidents table in blue db.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include 'IncidentsDB.php';
class Incident {
//Incident Properties    
    Private $ID;
    Private $Date;
    Private $Description;
    Private $Terminal;
    Private $Client;
    Private $Location;
    Private $Technician;
    Private $Department;
    Private $Status;
//constructing incident class    
    public function __construct($id, $date, $description, $terminal, $client, $location, $technician, $department, $status){
        $this->ID = $id;
        $this->Date = $date;
        $this->Description = $description;
        $this->Terminal = $terminal;
        $this->Client = $client;
        $this->Location = $location;
        $this->Technician = $technician;
        $this->Department = $department;
        $this->Status = $status;
    }
//sets incident instance properties when id property is known    
    public function setIncidentProperties($id){
        $db = new IncidentsDB();
        $IncidentDetails = $db->getIncident($id);
        foreach ($IncidentDetails as $incident):
            $this->ID = $incident['ID'];
            $this->Date = $incident['Date'];
            $this->Description = $incident['Description'];
            $this->Terminal = $incident['Term'];
            $this->Client = $incident['Client'];
            $this->Location = $incident['Location'];
            $this->Technician = $incident['Tech'];
            $this->Department = $incident['Department'];
            $this->Status = $incident['Status'];
        endforeach;
    }
//sets and gets incident properties    
    public function getID(){return $this->ID;}
    public function setID($ID){$this->ID = $ID;}
    public function getDate(){return $this->Date;}
    public function setDate($Date){$this->Date = $Date;}
    public function getDescription(){return $this->Description;}
    public function setDescription($Description){$this->Description = $Description;}
    public function getTerminal(){return $this->Terminal;}
    public function setTerminal($Terminal){$this->Terminal = $Terminal;}
    public function getClient(){return $this->Client;}
    public function setClient($Client){$this->Client = $Client;}
    public function getLocation(){return $this->Location;}
    public function setLocation($Location){$this->Location = $Location;}
    public function getTechnician(){return $this->Technician;}
    public function setTechnician($Technician){$this->Technician = $Technician;}
    public function getDepartment(){return $this->Department;}
    public function setDepartment($Department){$this->Department = $Department;}
     public function getStatus(){return $this->Status;}
    public function setStatus($Status){$this->Status = $Status;}
//insert incident instance into incidents table in blue db        
    public function saveIncident(){
        $db = new IncidentsDB();
        $db->addIncident($this->ID, $this->Date, $this->Description, $this->Terminal, $this->Client, $this->Location, $this->Technician, $this->Department);
    }
//updates row in inident table with instance values
    public function editIncident($prevID){
        $db = new IncidentsDB();
        $db->updateIncident($prevID, $this->ID, $this->Date, $this->Description, $this->Terminal, $this->Client, $this->Location, $this->Technician, $this->Department, $this->Status);
    }                   
//delete row in incident table specified by instance id property
    public function deleteIncident(){
        $db = new IncidentsDB();
        $db->deleteIncident($this->ID);
    }
}
