<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for editing a department instance.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'Department.php';

//creates new department instance and sets properties when name is known  
$editDepart = new Department(' ',' ',' ',' ',' ');   
if (isset($_GET['name'])){
    $editDepart->setDepartment($_GET['name']);
}
//set department properties to variables
$oldName = $editDepart->getName();
$Email1= $editDepart->getEmail1();
$Email2= $editDepart->getEmail2();
$Email3= $editDepart->getEmail3();
//update and exit when department properties have been edited
if (isset($_GET['oldname'])){
    $editDepart = new Department($_GET['name'],$_GET['email1'],$_GET['email2'],$_GET['email3']);
    $editDepart->updateDepartment($_GET['oldname']);
    sleep(0);
    header('location:Departments.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Department</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Edit department: <?php echo $oldName?></span>
                </div>
                <br><br>
<!--Creatiing from with values for editing department properties -->                
                <form class="form-horizontal" action="DepartmentEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldname" value="<?php echo $oldName; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="ID">Department Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?php echo $oldName; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email1">1st Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email1" value="<?php echo $Email1; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email2">2nd Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email2" value="<?php echo $Email2; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email3">3rd Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email3" value="<?php echo $Email3; ?>">
                        </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="Departments.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>