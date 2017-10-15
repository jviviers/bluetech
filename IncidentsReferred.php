<?php
/* 
 BlueTech Techncian Control System ATM Incidents page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
include_once 'Navigation.php';
include 'IncidentsDB.php';
include 'Client.php';
include 'Technician.php';

$prevPage = "";
//specifying department for incident retrieval
$department = $_GET['dep'];
//get all open and onhold incidents from incidents table where department specified
$db = new IncidentsDB();
$AllIncidents = $db->getReferredIncidents($department);

$db2 = new ClientDB();
$Clients = $db2->getDepartmentClients($department);

//setting cancel button href variable    
$prevPage = 'Incidents.php?dep='.$department;

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?PHP echo $department?> Referred Incidents</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div">                  
            </div>
<!-- get and display current date -->
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames"><?PHP echo $department?> Referred Incidents</div>
            <div class="col-sm-2"></div>
            <div class="dropdown col-sm-2" id="newincident">
                <a href="<?PHP echo $prevPage;?>" class="btn btn-warning dropdown-toggle btn-xs" role="button">Done</a>
            </div>
            <br>
<!-- Creates and display incidents retrieved in table format -->
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='2%'></th>
                        <th width='5%'>Ref#</th>
                        <th width='10%'>Date</th>
                        <th width='10%'>Client</th>
                        <th width='10%'>Technician</th>
                        <th width='8%'>Status</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllIncidents as $incident): ?>
                    <tr>
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
                                    echo $techName;
                            ?>
                        </td>
                        <td><?php echo $incident['Status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>