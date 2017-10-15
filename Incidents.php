<?php
/* 
 BlueTech Techncian Control System ATM Incidents page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
include_once 'Navigation.php';
include 'IncidentsDB.php';
include 'Client.php';
include 'Technician.php';

//specifying department for incident retrieval
$department = $_GET['dep'];
//get all open and onhold incidents from incidents table where department specified
$db = new IncidentsDB();
$AllIncidents = $db->getAllActiveIncidents($department);

$db2 = new ClientDB();
$Clients = $db2->getDepartmentClients($department);

$db3 = new TechnicianDB();
$Techs = $db3->getAllTechs();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?PHP echo $department?> Incidents</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div"></div>
<!-- get and display current date -->
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames"><?PHP echo $department?> Incidents</div>
            <div class="col-sm-2"></div>
            <div class="dropdown col-sm-2" id="newincident">
                                <button class="btn btn-warning dropdown-toggle btn-xs" type="button" data-toggle="dropdown">New Incident
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($Clients as $client): ?>
                                    <li><a href="IncidentNew.php?id=<?php echo $client['ID'];?>"><?php echo $client['Name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
            <br>
<!-- Creates and display incidents retrieved in table format -->
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th colspan="2"  width='1%' ><a href="IncidentsReferred.php?dep=<?php echo $department;?>" class="btn btn-primary btn-xs" role="button">
                            <span class="glyphicon glyphicon-forward"> Show Referred Incidents</span></a>
                        </th>
                        <th width='5%'>Ref#</th>
                        <th width='10%'>Date</th>
                        <th width='10%'>Client</th>
                        <th width='10%' style="padding-left: 2%">Technician</th>
                        <th width='8%'>Status</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllIncidents as $incident): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="IncidentStatusChange.php?ref1=<?php echo $incident['ID'];?>"><span class="glyphicon glyphicon-ban-circle" > Hold</span></a></li>
                                    <li><a href="IncidentStatusChange.php?ref2=<?php echo $incident['ID'];?>"><span class="glyphicon glyphicon-forward"> Refer</span></a></li>
                                    <li><a href="IncidentStatusChange.php?ref3=<?php echo $incident['ID'];?>"><span class="glyphicon glyphicon-ok"> Close</span></a></li>
                                    <li><a href="Delete.php?IID=<?php echo $incident['ID'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td style="text-align: center"><a href="IncidentUpdates.php?id=<?php echo $incident['ID'];?>" class="btn btn-info btn-xs" role="button"><span class="glyphicon glyphicon-pushpin"> Updates</span></a></td>
                        <!-- set link to view full incident details -->
                        <td><a href="IncidentDetails.php?id=<?php echo $incident['ID'];?>"><?php echo $incident['ID'] ?></a></td>
                        <td><?php echo $incident['Date'] ?></td>
                        <td><?php   $cl = new Client("", "", "", "", "", "");
                                    $clID = $incident['Client'];
                                    $cl->setClientProperties($clID);
                                    $clName = $cl->getName();
                                    echo $clName;?>
                        </td>
                        <td>
                            <?php   $tech = new Technician("", "", "", "", "");
                                    $techID = $incident['Tech'];
                                    $tech->setTechnician($techID);
                                    $techName = $tech->getFullName();
                            ?>
                            <div class="dropdown col-sm-2">
                                <button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><?PHP echo $techName;?>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($Techs as $tech): ?>
                                    <li><a href="IncidentAssignTech.php?iid=<?php echo $incident['ID'];?>&tid=<?php echo $tech['ID'];?>"><?php echo $tech['Name']." ".$tech['Surname']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $incident['Status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>