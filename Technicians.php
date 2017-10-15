<?php
/* 
 BlueTech Techncian Control System Manage technicians page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
include_once 'Navigation.php';
//include 'SecureUtil.php';
include 'TechnicianDB.php';
#Get all technicians from db
$db = new TechnicianDB();
$AllTechs = $db->getAllTechs(); 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Technicians</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div">
                
            </div>
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Manage Technicians</div>
            <div class="col-sm-4" id="addbutton">
                <a href="TechnicianNew.php" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Technician</span></a>
            </div>
            <br>
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%'></th>
                        <th width='10%'>ID</th>
                        <th width='10%'>Name</th>
                        <th width='10%'>Surname</th>
                        <th width='15%'>Phone</th>
                        <th width='10%'>Email</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllTechs as $tech): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?code=<?php echo $tech['ID'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="TechnicianEdit.php?code=<?php echo $tech['ID'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $tech['ID'] ?></td>
                        <td><?php echo $tech['Name'] ?></td>
                        <td><?php echo $tech['Surname'] ?></td>
                        <td><?php echo $tech['Phone'] ?></td>
                        <td><?php echo $tech['Email'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>


