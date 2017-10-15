<?php
/* 
 BlueTech Techncian Control System ATM Incidents page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
include_once 'Navigation.php';
//include 'SecureUtil.php';
include 'TerminalDB.php';
#Get all open and onhold incidents from db
$db = new TerminalDB();
$AllTerms = $db->getAllTerminals(); 




?>
<!DOCTYPE html>
<html>
    <head>
        <title>Termnals</title>
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
            <div class="col-sm-4" id="pagenames">Manage Terminals</div>
            <div class="col-sm-4" id="addbutton">
                <a href="TerminalNew.php" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Terminal</span></a>
            </div>
            <br>
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%'></th>
                        <th width='10%'>ID</th>
                        <th width='10%'>Client</th>
                        <th width='10%'>Site Name</th>
                        <th width='8%'>Location</th>
                        <th width='10%'>Serial</th>
                        <th width='10%'>Department</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllTerms as $term): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?tid=<?php echo $term['ID'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="TerminalEdit.php?tid=<?php echo $term['ID']?>-<?PHP echo $term['Name'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $term['ID'] ?></td>
                        <td><?php echo $term['Client'] ?></td>
                        <td><?php echo $term['Name'] ?></td>
                        <td><?php echo $term['Location'] ?></td>
                        <td><?php echo $term['Serial'] ?></td>
                        <td><?php echo $term['Department'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
