<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for display and management of a clients table in blue database.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//include 'SecureUtil.php';
include_once 'Navigation.php';
include 'ClientDB.php';
//get all clients from clients table in blue DB
$db = new ClientDB();
$AllClients = $db->getAllClients();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Clients</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div"></div>
<!-- Getting and displaying current date -->
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Manage Clients</div>
<!-- Creating new client button which directs to ClientNew.php -->
            <div class="col-sm-4" id="addbutton">
                <a href="ClientNew.php?code=<?php echo $tech['ID'];?>" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Client</span></a>
            </div>
            <br>
<!-- Displaying all clients in table with added buttons for client management -->
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%' ></th>
                        <th width='8%'>ID</th>
                        <th width='15%'>Name</th>
                        <th width='8%'>Department</th>
                        <th width='10%'>Phone</th>
                        <th width='10%'>1st Email</th>
                        <th width='10%'>2nd Email</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllClients as $client): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?ID=<?php echo $client['ID'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="ClientEdit.php?ID=<?php echo $client['ID'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $client['ID'] ?></td>
                        <td><?php echo $client['Name'] ?></td>
                        <td><?php echo $client['Department'] ?></td>
                        <td><?php echo $client['Phone'] ?></td>
                        <td><?php echo $client['Email1'] ?></td>
                        <td><?php echo $client['Email2'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
