<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for inserting new part into parts table.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'PartsDB.php';
//get all departments from DB for dropdown selection
$db = new DepartmentsDB();
$AllDepartments = $db->getAllDepartments();
//creates new partDB
$db2 = new PartsDB();
//inserts new part into table when form is submitted
if (isset($_GET['partnum'])){
    $db2->addPart($_GET['partnum'], $_GET['description'], $_GET['department']);
    sleep(0);
    header('location:Parts.php');
    exit;
}
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Part</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Part: </span>
                </div>
                <br><br>
<!--creating form for proprties input for new part to be added-->
                <form class="form-horizontal" action="PartNew.php" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="partnum">Part Number:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="partnum">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="description">Part Description:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="description">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="department">Department:</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="department" name="department">
                              <?php foreach ($AllDepartments as $depart): ?>
                              <option><?php echo $depart['Name']; ?></option>
                              <?php endforeach; ?>
                            </select>
                         </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="Parts.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>