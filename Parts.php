<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for managing and displaying parts table from blue DB.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include 'PartsDB.php';
include_once 'Navigation.php';
//getting all parts in parts table in blue db
$db = new PartsDB();
$AllParts = $db->getAllParts(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Parts</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div">
                
            </div>
<!--retrieving and displaying current date-->
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Manage Parts</div>
            <div class="col-sm-4" id="addbutton">
                <a href="PartNew.php" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Part</span></a>
            </div>
            <br>
<!-- Displaying parts table content in table format-->
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%'></th>
                        <th width='10%'>Part#</th>
                        <th width='15%'>Description</th>
                        <th width='8%'>Department</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllParts as $part): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?partnum=<?php echo $part['PartNum'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="PartsEdit.php?partnum=<?php echo $part['PartNum'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $part['PartNum'] ?></td>
                        <td><?php echo $part['Description'] ?></td>
                        <td><?php echo $part['Department'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
