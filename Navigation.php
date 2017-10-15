<?PHP
include 'DepartmentsDB.php';

$ddb = new DepartmentsDB();
$departments = $ddb->getAllDepartments();
?>
<!DOCTYPE html>
<!--
BlueTech Techncian Control System Navigation page
Developed by Jacques Viviers (ITE-University of South Africa)
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Bootstrap, ajax, and css file-->        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="BTCSS2.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="#" style="color: darkblue">BlueTech</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="dashboard.php">Dashboard</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Incidents
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($departments as $depart): ?>
                            <li><a href="Incidents.php?dep=<?PHP echo $depart['Name']?>"><?PHP echo $depart['Name']?> Incidents</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Terminals.php">Terminals</a></li>
                            <li><a href="Clients.php">Clients</a></li>
                            <li><a href="Technicians.php">Technicians</a></li>
                            <li><a href="Parts.php">Parts</a></li>
                            <li><a href="Locations.php">Locations</a></li>
                            <li><a href="Departments.php">Departments</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Technician</a></li>
                            <li><a href="#">Incident</a></li>
                            <li><a href="#">Parts</a></li>
                        </ul>
                    </li>
                </ul>
                 <ul class="nav navbar-nav navbar-right">
                     <li><a href="#"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
                    <li><a href="index.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
    </body>
</html>
