<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for inserting new location instance into locations table in blue DB.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'LocationDB.php';
//creating new instance of locationDB.
$db = new LocationDB(); 
//inserts new instance of location when form submitted and exit
if (isset($_GET['city'])){
    $db->addLocation($_GET['city'], $_GET['region']);
    sleep(0);
    header('location:Locations.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New Location</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Add New Location</span>
                </div>
                <br><br>
<!-- creates and displays form for location properties input -->
                <form class="form-horizontal" action="LocationsNew.php" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="city">City:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="city">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="region">Region:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="region">
                        </div>
                    </div>
                    <div class="col-sm-2"> </div>
                    <div class="col-sm-8" style="text-align: right">
                        <a href="Locations.php" class="btn btn-warning" role="button">Cancel</a>    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </body>
</html>
