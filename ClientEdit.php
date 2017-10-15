<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for editing of a client instance.
 * @author Jacques Viviers jviviers007@gmail.com
 */

//include 'SecureUtil.php';
include 'Navigation.php';
include 'Client.php';
//get all departments for dropdownlist from database
$db = new DepartmentsDB();
$AllDepartments = $db->getAllDepartments(); 
//create a new instance of client    
$editClient = new Client(' ',' ',' ',' ',' ',' ');   
if (isset($_GET['ID'])){
    $editClient->setClientProperties($_GET['ID']);
}
//Set client properties to variables
$OldID = $editClient->getID();
$Name= $editClient->getName();
$Phone= $editClient->getPhone();
$Email1= $editClient->getEmail1();
$Email2= $editClient->getEmail2();
$Department= $editClient->getDepartment();
//Create new Client instance and update old client details in database
if (isset($_GET['oldid'])){
    $editedClient = new Client($_GET['id'],$_GET['name'],$_GET['phone'],$_GET['email1'],$_GET['email2'],$_GET['department']);
    $editedClient->editClient($_GET['oldid']);
    sleep(0);
    header('location:Clients.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Client</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
<!-- Displaying client details which is up for editing -->
                <div class="col-sm-12" id="editName">
                   <span>Edit Client: <?php echo $OldID.' - '.$Name;?></span>
                </div>
                <br><br>
<!-- Creating form for input and displaying properties to edit -->
                <form class="form-horizontal" action="ClientEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldid" value="<?php echo $OldID; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="ID">Client ID:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="id" value="<?php echo $OldID; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?php echo $Name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="phone">Phone:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="phone" value="<?php echo $Phone; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email1">Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email1" value="<?php echo $Email1; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email2">Second Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email2" value="<?php echo $Email2; ?>">
                        </div>
                    </div>
    <!-- creating dropdown for department selection -->
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
                        <a href="Clients.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>

