<?php
//include 'SecureUtil.php';
include 'Navigation.php';
include 'Technician.php';

#new technician class and set technician class properties    
$editTech = new Technician(' ',' ',' ',' ',' ');   
if (isset($_GET['code'])){
    $editTech->setTechnician($_GET['code']);
}
#Set properties to variables
$oldcodeValue = $editTech->getTechID();
$nameValue= $editTech->getName();
$surnameValue= $editTech->getSurname();
$emailValue= $editTech->getEmail();
$cellValue= $editTech->getPhone();
#Create new Technician and update old technician details
if (isset($_GET['oldcode'])){
    $editedTech = new Technician($_GET['editecode'],$_GET['name'],$_GET['surname'],$_GET['cell'],$_GET['email']);
    $editedTech->updateTechnician($_GET['oldcode']);
    sleep(0);
    header('location:Technicians.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Technician</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Edit employee: <?php echo $oldcodeValue.' - '.$nameValue.' '.$surnameValue;?></span>
                </div>
                <br><br>
                <form class="form-horizontal" action="TechnicianEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldcode" value="<?php echo $oldcodeValue; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="ID">Employee Code:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="editecode" value="<?php echo $oldcodeValue; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name">Name:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="name" value="<?php echo $nameValue; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="surname">Surname:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="surname" value="<?php echo $surnameValue; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="phone">Phone number:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="cell" value="<?php echo $cellValue; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email">Email address:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="<?php echo $emailValue; ?>">
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