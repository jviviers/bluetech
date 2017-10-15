<?php
/* 
 * Copyright (C) 2017 Jacques Viviers
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once 'Navigation.php';
include 'Incident.php';
include 'TechnicianDB.php';
include 'Client.php';
include 'TerminalDB.php';
include 'LocationDB.php';
// assigning new db's
$termDB = new TerminalDB();
$dbTech = new TechnicianDB();
$dbLoc = new LocationDB();
//declaring variables
$department = '';
$clientID = '';
$prevPage = '';
//get client id and set selected properties to variables
if (isset($_GET['id'])){
    $currentClient = new Client(" ", " ", " ", " ", " ", " ");
    $currentClient->setClientProperties($_GET['id']);
    $department = $currentClient->getDepartment();
    $clientID = $currentClient->getID();
    $clientName = $currentClient->getName();
//get terminals, technicians, and locations    
    $AllTerminals = $termDB->getClientTerminals($clientName);
    $AllTechnicians = $dbTech->getAllTechs();
    $AllLocations = $dbLoc->getAllLocations();
//setting cancel button href variable    
$prevPage = 'Incidents.php?dep='.$department;

}
//setting variables/properties for new incident and add new incident
if (isset($_GET['ref'])){
    $dateTime = date("Y-m-d h:i:sa");
    $status = 'Open';
    $FullTerminal = $_GET['term'];
    $TermDet = explode('-',$FullTerminal);
    $TermID = $TermDet[0];
    $TermN = $TermDet[2];
    $termName = trim($TermID)." - ".trim($TermN);
    $Located = $TermDet[1];
    $location = trim($Located);
    $department = $_GET['depart'];
    $techDet = explode("-", $_GET['tech']);
    $techID = trim($techDet[0]);
    $newIncident = new Incident($_GET['ref'], $dateTime, $_GET['description'], $termName, $_GET['clientID'], $location, $techID, $department, $status);
    $newIncident->saveIncident();
//exits to selected department incidents page
    sleep(0);
    header('location:Incidents.php?dep='.$department);
    exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Incident</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Incident</span>
                </div>
                <br><br>
<!-- Creating form for new client properties input -->
                <form class="form-horizontal" action="IncidentNew.php" method="get">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="clientID" id="clientID" value="<?php echo $clientID; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="depart" id="depart" value="<?php echo $department; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="ref">Reference:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="ref">
                        </div>
                    </div>
<!-- Displaying dropdown menu for terminal selection -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="term">Terminal:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="term" name="term">
                              <?php foreach ($AllTerminals as $term): ?>
                              <option><?php echo $term['ID'].' - '.$term['Location'].' - '.$term['Name'];?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="description">Description:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="description">
                        </div>
                    </div>
<!-- Displaying dropdown menu for technician selection -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="tech">Technician:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="tech" name="tech">
                              <?php foreach ($AllTechnicians as $tech): ?>
                              <option><?php echo $tech['ID']." - ". $tech['Name']." ".$tech['Surname'] ?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="<?PHP echo $prevPage;?>" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>