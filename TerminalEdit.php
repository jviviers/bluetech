<?php
//include 'SecureUtil.php';
include 'Navigation.php';
include 'ClientDB.php';
include 'LocationDB.php';
include 'Terminal.php';
//get all departments, Clients, Locations for dropdownlist from database
$db = new DepartmentsDB();
$AllDepartments = $db->getAllDepartments();
$db2 = new ClientDB();
$AllClients = $db2->getAllClients();
$db3 = new LocationDB();
$AllLocations = $db3->getAllLocations();
//create a new instance of client    
$editTerm = new Terminal(' ',' ',' ',' ',' ',' ');   
if (isset($_GET['tid'])){
    $termdet = explode("-", $_GET['tid']);
    $termid = trim($termdet[0]);
    $termname = trim($termdet[1]);
    $editTerm->setTerminalProperties($termid, $termname);
}
//Set client properties to variables
$OldID = $editTerm->getID();
$Name= $editTerm->getName();
$Serial= $editTerm->getSerial();
$Location= $editTerm->getLocation();
$Department= $editTerm->getDepartment();
$Client= $editTerm->getClient();
//Create new terminal instance and update old terminal details in database
if (isset($_GET['oldtid'])){
    $editedTerm = new Terminal($_GET['id'],$_GET['name'],$_GET['serial'],$_GET['location'],$_GET['client'],$_GET['department']);
    $editedTerm->editTerminal($_GET['oldtid']);
    sleep(0);
    header('location:Terminals.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Terminal</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Edit Terminal: <?php echo $OldID.' - '.$Name.' '.$Serial.' '.$Client.' '.$Location;?></span>
                </div>
                <br><br>
                <form class="form-horizontal" action="TerminalEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldtid" value="<?php echo $OldID; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="id">Terminal ID:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="id" value="<?php echo $OldID; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Site Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?php echo $Name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="serial">Serial:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="serial" value="<?php echo $Serial; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="client">Client:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="client" name="client">
                              <?php foreach ($AllClients as $client): ?>
                              <option><?php echo $client['Name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="location">Location:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="location" name="location">
                              <?php foreach ($AllLocations as $loc): ?>
                              <option><?php echo $loc['City'] ?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="department">Department:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="department" name="department">
                              <?php foreach ($AllDepartments as $depart): ?>
                              <option><?php echo $depart['Name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="Terminals.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>
