<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for managing and displaying locations table from blue DB.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//Dispplays navigation on top of page
include_once 'Navigation.php';
//include 'SecureUtil.php';
include 'LocationDB.php';
//getting all locations from locations table in DB
$db = new LocationDB();
$AllLocations = $db->getAllLocations(); 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Locations</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div"></div>
<!--Gets current date and display -->            
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Manage Locations</div>
            <div class="col-sm-4" id="addbutton">
                <a href="LocationsNew.php" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Location</span></a>
            </div>
            <br>
<!--Dispalys locations and properties in table -->            
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%'></th>
                        <th width='15%'>City</th>
                        <th width='15%'>Region</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllLocations as $loc): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?city=<?php echo $loc['City'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="LocationsEdit.php?city=<?php echo $loc['City'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $loc['City'] ?></td>
                        <td><?php echo $loc['Region'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
