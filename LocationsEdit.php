<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for editing of a location instance.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'Navigation.php';
include 'LocationDB.php';
//get location for editing from locations table in blue database where city is known
$db = new LocationDB();
$Location = $db->getLocation($_GET['city']); 
//sets location's properties to variable
$City = ' ';
$Region = ' ';
foreach ($Location as $loc):
$City = $loc['City'];
$Region = $loc['Region'];
endforeach;
//saves edited locationinstance to locations table in blue db and exits
if (isset($_GET['oldcity'])){
    $editedLocation = $db->editLocation($_GET['oldcity'],$_GET['city'],$_GET['region']);
    sleep(0);
    header('location:Locations.php');
    exit;
}
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Location</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
       <body>
            <div class="container-fluid">
                <div class="col-sm-12" id="editName">
                   <span>Edit Location: <?php echo $City.' - '.$Region;?></span>
                </div>
                <br><br>
<!-- Creates form inputs with values for editing location properties -->                
                <form class="form-horizontal" action="LocationsEdit.php" method="get">
                    <div class="form-group">
                      <input type="hidden" name="oldcity" value="<?php echo $City; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="city">City:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="city" value="<?php echo $City; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="region">Region:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="region" value="<?php echo $Region; ?>">
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


