<?php
/* 
 BlueTech Techncian Control System ATM Incidents page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
include_once 'Navigation.php';
include 'Incident.php';
include 'Client.php';
include 'Technician.php';
include_once 'Department.php';

$prevPage = '';

$inc = new Incident("", "", "", "", "", "", "", "", "");

$reference = $_GET['id'];
$inc->setIncidentProperties($reference);

$dateTime = $inc->getDate();
$status = $inc->getStatus();
$clientID = $inc->getClient();
$department = $inc->getDepartment();
$description = $inc->getDescription();
$location = $inc->getLocation();
$techID = $inc->getTechnician();
$term = $inc->getTerminal();
$termDet = explode(" - ", $term);
$termID = trim($termDet[0]);
$termSite = trim($termDet[1]);


$tech = new Technician("", "", "", "", "");
$tech->setTechnician($techID);
$techName = $tech->getFullName();
$techPhone = $tech->getPhone();
$techMail = $tech->getEmail();

$cli = new Client("", "", "", "", "", "");
$cli->setClientProperties($clientID);
$clientName = $cli->getName();
$clientPhone = $cli->getPhone();
$clientMail1 = $cli->getEmail1();
$clientMail2 = $cli->getEmail2();

$dep = new Department("", "", "", "");
$dep->setDepartment($department);
$depMail1 = $dep->getEmail1();
$depMail2 = $dep->getEmail2();
$depMail3 =$dep->getEmail3();
$prevPage = 'Incidents.php?dep='.$department;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Incident Details</title>
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
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <br>
<!-- Creates and display incidents retrieved in table format -->
            <table class="table table-striped table-bordered table-condensed table-responsive" >
                <thead style="font-family:verdana">
                    <tr>
                        <th width='5%' colspan="4">Full Incident Details</th>  
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <tr>
                        <td style="font-weight: bolder">Refrence Number</td>
                        <td style="font-weight: bolder" colspan="2">Date & Time Logged</td>
                        <td style="font-weight: bolder">Status</td>
                    </tr>
                    <tr>
                        <td><?PHP echo $reference;?></td>
                        <td colspan="2"><?PHP echo $dateTime;?></td>
                        <td><?PHP echo $status;?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Client</td>
                        <td style="font-weight: bolder">Phone</td>
                        <td style="font-weight: bolder">1st Email</td>
                        <td style="font-weight: bolder">2nd Email</td>
                        
                    </tr>
                    <tr>
                        <td><?PHP echo $clientName;?></td>
                        <td><?PHP echo $clientPhone;?></td>
                        <td><?PHP echo $clientMail1;?></td>
                        <td><?PHP echo $clientMail2;?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Terminal ID</td>
                        <td style="font-weight: bolder">Site Name</td>
                        <td style="font-weight: bolder">Location</td>
                        <td style="font-weight: bolder">Fault Description</td>
                    </tr>
                    <tr>
                        <td><?PHP echo $termID;?></td>
                        <td><?PHP echo $termSite;?></td>
                        <td><?PHP echo $location;?></td>
                        <td><?PHP echo $description;?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Technician</td>
                        <td style="font-weight: bolder">Phone</td>
                        <td style="font-weight: bolder" colspan="2">Email</td>
                    </tr>
                    <tr>
                        <td><?PHP echo $techName;?></td>
                        <td><?PHP echo $techPhone;?></td>
                        <td colspan="2"><?PHP echo $techMail;?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bolder">Department</td>
                        <td style="font-weight: bolder">1st Email</td>
                        <td style="font-weight: bolder">2nd Email</td>
                        <td style="font-weight: bolder">3rd Email</td>
                    </tr>
                    <tr>
                        <td><?PHP echo $department;?></td>
                        <td><?PHP echo $depMail1;?></td>
                        <td><?PHP echo $depMail2;?></td>
                        <td><?PHP echo $depMail3;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12" style="text-align: center">
        <a href="<?PHP echo $prevPage;?>" class="btn btn-warning" role="button">Done</a>
        </div>
    </body>
</html>