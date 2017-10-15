<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for saving a new instance of a client to the clients table in blue db.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'Department.php';
include 'Client.php';
//get all departments from department table in blue database
$db = new DepartmentsDB();
$AllDepartments = $db->getAllDepartments(); 
//check if new client details has been submitted and saves to client table in blue database
if (isset($_GET['name'])){
    $newClient = new Client($_GET['name'], $_GET['phone'], $_GET['email1'],$_GET['email2'],$_GET['department']);
    $newClient->saveClient();
    sleep(0);
    header('location:Clients.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Client</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Client</span>
                </div>
                <br><br>
<!-- Creating form for new client properties input -->
                <form class="form-horizontal" action="ClientNew.php" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Client's Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="phone">Phone:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email1">1st Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email1">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email2">2nd Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email2">
                        </div>
                    </div>
    <!-- Displaying dropdown menu for department selection -->
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

