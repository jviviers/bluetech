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
//Create new terminal instance and update old terminal details in database
if (isset($_GET['id'])){
    $newTerm = new Terminal($_GET['id'],$_GET['name'],$_GET['serial'],$_GET['location'],$_GET['client'],$_GET['department']);
    $newTerm->saveTerminal();
    sleep(0);
    header('location:Terminals.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Terminal</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Terminal:</span>
                </div>
                <br><br>
                <form class="form-horizontal" action="TerminalNew.php" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="id">Terminal ID:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Site Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="serial">Serial:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="serial">
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


