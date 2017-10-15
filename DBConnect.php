<?php
class DBConnect {

    private static $dsn = 'mysql:host=localhost;dbname=blue'; private static $username = 'root'; private static $password = '';  private $dbx;

    public function __construct() {     }
    public function getdbx() {   
        try {$this->dbx = new PDO (self::$dsn, self::$username, self::$password);}
            catch (PDOException $ex) {echo "Sorry, cannot connect to Server".$ex;}        
        return $this->dbx;
    }
    //Table Technicians
   
    // Table Incidents
    public function getIncidentDb($Ref){
        $dbx = DBConnect::getdbx();   $ref = $Ref;
        $selectTasks = 'SELECT * FROM incidents WHERE Ref = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $ref);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function InsertIncident($Ref, $DateTime, $Desc, $Term, $Serial, $Client, $Tech, $Location, $Type){
        $dbx = DBConnect::getdbx();   $ref = $Ref; $dt = $DateTime;   $desc = $Desc; $term = $Term;   $serial = $Serial; $type = $Type;
        $client = $Client;   $ass = $Tech;   $location = $Location;   $status = "Open";
        $insert = 'INSERT INTO incidents (Ref, Date_Time_Logged, Description, Terminal, Serial, Client, Assigned_to, Status, Location, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $ref);   $insertstate->bindValue(2, $dt);   $insertstate->bindValue(3, $desc);
        $insertstate->bindValue(4, $term);   $insertstate->bindValue(5, $serial);   $insertstate->bindValue(6, $client);
        $insertstate->bindValue(7, $ass);   $insertstate->bindValue(8, $status);   $insertstate->bindValue(9, $location); $insertstate->bindValue(10, $type);
        $insertstate->execute();   $insertstate->closeCursor();
    }
    public function updateIncident ($RefToUpdate, $ref, $logged, $description, $terminal, $serial, $client, $techn, $location, $status){
        $PrevRef = $RefToUpdate;   $Ref = $ref;    $Logged = $logged;  $Desc = $description;   $Term = $terminal;
        $Serial = $serial;   $Client = $client;   $Tech = $techn;   $Loc = $location;    $Stat = $status;
        $dbx = DBConnect::getdbx();
        $update = 'UPDATE incidents SET Ref = ?, Date_Time_Logged = ?, Description = ?, Terminal = ?, Serial = ?, Client = ?, Assigned_to = ?, Location = ?, Status = ? WHERE Ref = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $Ref);   $updatestate->bindValue(2, $Logged);   $updatestate->bindValue(3, $Desc);
        $updatestate->bindValue(4, $Term);   $updatestate->bindValue(5, $Serial);   $updatestate->bindValue(6, $Client);
        $updatestate->bindValue(7, $Tech);   $updatestate->bindValue(8, $Loc);   $updatestate->bindValue(9, $Stat);   $updatestate->bindValue(10, $PrevRef);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function getOIncidentsDb(){
        $dbx = DBConnect::getdbx();   $status1 ='Closed';   $status2 ='Referred';
        $selectTasks = 'SELECT Ref, Date_Time_Logged, Client, Assigned_to, Status FROM incidents WHERE Type = "ATM or Xerox" AND Status NOT IN (?, ?)';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $status1);   $state->bindValue(2, $status2);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
     public function getOIncidentsDb2(){
        $dbx = DBConnect::getdbx();   $status1 ='Closed';   $status2 ='Referred';
        $selectTasks = 'SELECT Ref, Date_Time_Logged, Client, Assigned_to, Status FROM incidents WHERE Type = "Retail" AND Status NOT IN (?, ?)';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $status1);   $state->bindValue(2, $status2);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getRIncidentsDb(){
        $dbx = DBConnect::getdbx();   $status ='Referred';
        $selectTasks = 'SELECT Ref, Date_Time_Logged, Client, Assigned_to, Status FROM incidents WHERE Status = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $status);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function reAsssignIncident ($RefToUpdate, $techn){
        $PrevRef = $RefToUpdate;   $Tech = $techn;   $dbx = DBConnect::getdbx();
        $update = 'UPDATE incidents SET Assigned_to = ? WHERE Ref = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $Tech);   $updatestate->bindValue(2, $PrevRef);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function getTechNumOpenCalls($tCode){
        $dbx = DBConnect::getdbx();   $status1 ='Closed';   $status2 ='Referred';   $tech = $tCode;
        $selectTasks = 'SELECT COUNT(*) as Total FROM incidents WHERE Assigned_to = ? AND Status NOT IN (?, ?)';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $tech);   $state->bindValue(2, $status1);   $state->bindValue(3, $status2);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems;
    }
      // Table Clients
    
    //Table Parts
    public function addPart($partNumber, $description){
        $dbx = DBConnect::getdbx();   $PN = $partNumber;   $Desc = $description;
        $insert = 'INSERT INTO parts (PartNum, Description) VALUES (?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $PN);   $insertstate->bindValue(2, $Desc);
        $insertstate->execute();   $insertstate->closeCursor();
    }
    public function editPart($oldnumber,$newnumber, $description){
        $OldPN = $oldnumber;   $NewPN = $newnumber;   $Desc = $description;   $dbx = DBConnect::getdbx();
        $update = 'UPDATE parts SET PartNum = ?, Description = ? WHERE PartNum = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $NewPN);   $updatestate->bindValue(2, $Desc);   $updatestate->bindValue(3, $OldPN);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function getPart($partnumber){
        $dbx = DBConnect::getdbx();   $PN = $partnumber;
        $selectTasks = 'SELECT * FROM parts WHERE PartNum = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $PN);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function BookParts($partnum, $qty, $emp, $wo){
        $dbx = DBConnect::getdbx();   $PartNum = $partnum;   $Qty = $qty;   $Tech = $emp;   $WO = $wo;
        $insert = 'INSERT INTO parts_booked (PartNum, WO, Qty, Technician) VALUES (?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $PartNum);   $insertstate->bindValue(2, $WO);   $insertstate->bindValue(3, $Qty);   $insertstate->bindValue(4, $Tech);
        $insertstate->execute(); $insertstate->closeCursor();
    }
    public function RecieveParts($dt, $partnum, $qty, $emp, $doc){
        $dbx = DBConnect::getdbx();   $DateTime = $dt;   $PartNum = $partnum;   $Qty = $qty;   $Tech = $emp;   $Doc = $doc;
        $insert = 'INSERT INTO parts_recieved (DateTime, PartNum, WO, Qty, Technician) VALUES (?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $DateTime);   $insertstate->bindValue(2, $PartNum);   $insertstate->bindValue(3, $Doc);
        $insertstate->bindValue(4, $Qty);   $insertstate->bindValue(5, $Tech);
        $insertstate->execute(); $insertstate->closeCursor();
    }
    public function getParts(){
        $dbx = DBConnect::getdbx();
        $selectTasks = 'SELECT * FROM parts';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
     public function deletePart($partnumber){
        $dbx = DBConnect::getdbx();   $itemDel = $partnumber;
        $deleteDB = 'DELETE FROM parts WHERE PartNum = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
    public function getWOParts($wo){
        $dbx = DBConnect::getdbx();   $WOrder = $wo;
        $selectTasks = 'SELECT (PartNum, Qty) FROM parts_booked WHERE WO = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $WOrder);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    //Table Terminals
    public function getTerminal($serial){
        $Serial = $serial;   $dbx = DBConnect::getdbx();
        $selectTasks = 'SELECT * FROM terminals WHERE Serial = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $Serial);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function addTerminal($serial,$term,$model,$client,$installed,$location){
        $SN = $serial;   $ID = $term;   $Mod = $model;   $Client = $client;   $Install = $installed;   $Site = $location;
        $dbx = DBConnect::getdbx();
        $insert = 'INSERT INTO terminals (Serial, TermID, Model, Client, Installation_Date, Site_Description) VALUES (?, ?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $SN);   $insertstate->bindValue(2, $ID);   $insertstate->bindValue(3, $Mod);
        $insertstate->bindValue(4, $Client);   $insertstate->bindValue(5, $Install);   $insertstate->bindValue(6, $Site);
        $insertstate->execute();   $insertstate->closeCursor();
    }
    public function editTerminal($oldSN, $newSN, $mod, $term, $client, $site, $installed){
        $PrevSN = $oldSN;   $SN = $newSN;   $Model = $mod;   $ID = $term;   $Client = $client;   $Site = $site;   $Date = $installed;
        $dbx = DBConnect::getdbx();
        $update = 'UPDATE terminals SET Serial = ?, TermID = ?, Model = ?, Client = ?, Installation_Date = ?, Site_Description = ? WHERE Serial = ?';
        $updatestate = $dbx->prepare($update);
        $updatestate->bindValue(1, $SN);   $updatestate->bindValue(2, $ID);   $updatestate->bindValue(3, $Model);
        $updatestate->bindValue(4, $Client);   $updatestate->bindValue(5, $Date);   $updatestate->bindValue(6, $Site);   $updatestate->bindValue(7, $PrevSN);
        $updatestate->execute();   $updatestate->closeCursor();
    }
    public function deleteTerm($serial){
        $dbx = DBConnect::getdbx();   $itemDel = $serial;
        $deleteDB = 'DELETE FROM terminals WHERE Serial = ?';
        $delStatement = $dbx->prepare($deleteDB);
        $delStatement->bindValue(1,$itemDel);
        $delStatement->execute();   $delStatement->closeCursor(); 
    }
    public function getTerminals(){
        $dbx = DBConnect::getdbx();
        $selectTasks = 'SELECT * FROM terminals';
        $state = $dbx->prepare($selectTasks);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getClientTerminals($Client){
    $dbx = DBConnect::getdbx();   $clientelle = $Client;
    $selectTasks = 'SELECT * FROM terminals WHERE Client = ?';
    $state = $dbx->prepare($selectTasks);
    $state->bindValue(1, $clientelle);
    $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
    return $selitems; 
}
    //Table Travel
    public function getTripInfo($Trip){
        $dbx = DBConnect::getdbx();   $trip = $Trip;
        $selectTasks = 'SELECT * FROM travel WHERE Trip = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $trip);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getTravelMaxDate($emp_code){
        $dbx = DBConnect::getdbx();   $emp = $emp_code;
        $select = 'SELECT MAX(Start_DateTime)FROM travel WHERE Emp_code = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $emp);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getTechTraveling($maxDate, $emp){
        $dbx = DBConnect::getdbx();   $EC = $emp;   $MD = $maxDate;
        $select = 'SELECT * FROM travel WHERE Start_DateTime = ? AND Emp_code = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $MD);   $state->bindValue(2, $EC);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    //Table Work Orders
    public function InsertWO($start, $end, $ref, $trip, $desc, $fc, $pc, $emp){
        $dbx = DBConnect::getdbx();   $Start = $start;   $End = $end;   $Ref = $ref;   $Trip = $trip;   $Desc = $desc;
        $Fix = $fc;   $Prob = $pc;   $Emp = $emp;
        $insert = 'INSERT INTO work_orders (Start, End, Ref, Trip, Description, Fix_Code, Problem_Code, Emp_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $Start);   $insertstate->bindValue(2, $End);   $insertstate->bindValue(3, $Ref);
        $insertstate->bindValue(4, $Trip);   $insertstate->bindValue(5, $Desc);   $insertstate->bindValue(6, $Fix);
        $insertstate->bindValue(7, $Prob);   $insertstate->bindValue(8, $Emp);
        $insertstate->execute(); $insertstate->closeCursor();
    }
    public function  UpdateWO($woEnd, $woDesc, $woFix, $woProb, $empC) {
        $dbx = DBConnect::getdbx();   $End = $woEnd;   $Desc = $woDesc;   $Fix = $woFix;   $Prob = $woProb;   $Empl = $empC;
        $insert = 'UPDATE work_orders SET End = ?, Description = ?, Fix_Code = ?, Problem_Code = ? WHERE Emp_code = ? AND End IS NULL';
        $insertstate = $dbx->prepare($insert);
        $insertstate->bindValue(1, $End);   $insertstate->bindValue(2, $Desc);   $insertstate->bindValue(3, $Fix);
        $insertstate->bindValue(4, $Prob);   $insertstate->bindValue(5, $Empl);
        $insertstate->execute(); $insertstate->closeCursor();
    }
    public function getWorkOrder($woNumber){
        $dbx = DBConnect::getdbx();   $WO = $woNumber;
        $selectTasks = 'SELECT * FROM work_orders WHERE WO = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $WO);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getAttendMaxDate($emp_code){
        $dbx = DBConnect::getdbx();   $emp = $emp_code;
        $select = 'SELECT MAX(Start)FROM work_orders WHERE Emp_code = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $emp);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getTechAttending($maxDate, $emp){
        $dbx = DBConnect::getdbx();   $EC = $emp;   $MD = $maxDate;
        $select = 'SELECT * FROM work_orders WHERE Start = ? AND Emp_code = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $MD);   $state->bindValue(2, $EC);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getIncidentUpdates($Ref){
        $dbx = DBConnect::getdbx();   $ref = $Ref;
        $selectTasks = 'SELECT * FROM work_orders WHERE Ref = ?';
        $state = $dbx->prepare($selectTasks);
        $state->bindValue(1, $ref);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    //Table Time_Clocked 
    public function getOfficeMaxDate($emp_code){
        $dbx = DBConnect::getdbx();   $emp = $emp_code;
        $select = 'SELECT MAX(Start)FROM time_clocked WHERE Employee = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $emp);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    public function getTechOffice($maxDate, $emp){
        $dbx = DBConnect::getdbx();   $EC = $emp;   $MD = $maxDate;
        $select = 'SELECT * FROM time_clocked WHERE Start = ? AND Employee = ?';
        $state = $dbx->prepare($select);
        $state->bindValue(1, $MD);   $state->bindValue(2, $EC);
        $state->execute();   $selitems = $state->fetchAll();   $state->closeCursor();
        return $selitems; 
    }
    function getPass($checkUser){
        $dbx = DBConnect::getdbx();
        $UserN = $checkUser;
        $selectUser = 'SELECT Password FROM loginusers WHERE Username = ?';
        $state = $dbx->prepare($selectUser);
        $state->bindValue(1, $UserN);
        $state->execute();
        $selitems = $state->fetchAll();
        $state->closeCursor();
        return $selitems; 
    }
}