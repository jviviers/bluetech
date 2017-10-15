<?php
//include 'SecureUtil.php';
include 'Navigation.php';
include 'Technician.php';

if (isset($_GET['editecode'])){
    $editedTech = new Tech($_GET['editecode'],$_GET['name'],$_GET['surname'],$_GET['cell'],$_GET['email']);
    $editedTech->saveTechnician();
    sleep(0);
    header('location:Technicians.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Technician</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Technician</span>
                </div>
                <br><br>
                <form class="form-horizontal" action="TechnicianNew.php" method="get">
                  
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="ID">Employee Code:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="editecode">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="surname">Surname:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="surname">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="phone">Phone number:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="cell">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email">Email address:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="Technicians.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>