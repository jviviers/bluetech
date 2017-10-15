<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for inserting new department instance into department table in blue db.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'Department.php';
//saves new department to blue database and exits
if (isset($_GET['name'])){
    $newDepartment = new Department($_GET['name'],$_GET['email1'],$_GET['email2'],$_GET['email3']);
    $newDepartment->saveDepartment();
    sleep(0);
    header('location:Departments.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Department</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Department</span>
                </div>
                <br><br>
<!--Creating blank form for new department properties input -->                
                <form class="form-horizontal" action="DepartmentNew.php" method="get">
                  
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Department Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name">
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
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email3">3rd Email:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="email3">
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
