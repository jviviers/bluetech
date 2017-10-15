<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for editing part instance in parts table
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
//Sets part to edit property values to varaibles  
if (isset($_GET['partnum'])){
    $editPart = $db2->getPartDesciption($_GET['partnum']);
    $PartNum = $_GET['partnum'];
    foreach ($editPart as $part):
        $Description = $part['Description'];
        $Department = $part['Department'];
    endforeach;    
}
//update part when edit complete (submitted)
if (isset($_GET['oldPN'])){
    $db2->editPart($_GET['oldPN'], $_GET['partnum'], $_GET['description'], $_GET['department']);
    sleep(0);
    header('location:Parts.php');
    exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Part</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Edit Part: <?php echo $PartNum.' - '.$Description.' ('.$Department.')';?></span>
                </div>
                <br><br>
<!--Creating form with values for editing part properties-->
                <form class="form-horizontal" action="PartsEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldPN" value="<?php echo $PartNum; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="partnum">Part Number:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="partnum" value="<?php echo $PartNum; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="description">Part Description:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="description" value="<?php echo $Description; ?>">
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