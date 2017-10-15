<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for displaying department table content from blue db.
 * @author Jacques Viviers jviviers007@gmail.com
 */
//includes navigation bar
include_once 'Navigation.php';
//include 'SecureUtil.php';

//gets all departments from departments table in blue db
$db = new DepartmentsDB();
$AllDepartments = $db->getAllDepartments(); 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Departments</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div">
                
            </div>
<!-- Get and display current date -->            
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Manage Departments</div>
            <div class="col-sm-4" id="addbutton">
                <a href="DepartmentNew.php" class="btn btn-warning btn-xs" role="button">
                    <span class="glyphicon glyphicon-plus"> New Department</span></a>
            </div>
            <br>
<!--Creates table and displays departments' properties-->            
            <table class="table table-striped table-condensed table-responsive" >
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width='1%'></th>
                        <th width='10%'>Name</th>
                        <th width='10%'>1st Email</th>
                        <th width='10%'>2nd Email</th>
                        <th width='15%'>3rd Email</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana;" >
                    <?php foreach ($AllDepartments as $depart): ?>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Options
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="Delete.php?name=<?php echo $depart['Name'];?>"><span class="glyphicon glyphicon-remove" > Delete</span></a></li>
                                    <li><a href="DepartmentEdit.php?name=<?php echo $depart['Name'];?>"><span class="glyphicon glyphicon-pencil"> Edit</span></a></li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $depart['Name'] ?></td>
                        <td><?php echo $depart['Email1'] ?></td>
                        <td><?php echo $depart['Email2'] ?></td>
                        <td><?php echo $depart['Email3'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>