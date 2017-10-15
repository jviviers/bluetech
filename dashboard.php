<?php
/* 
 BlueTech Techncian Control System Dashboard page
 Developed by Jacques Viviers (ITE-University of South Africa)
 */
//include 'SecureUtil.php';
//include 'TechStatus.php';
include_once 'Navigation.php';
session_start();
$arrCounter = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dash</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          </head>
    <body>
        <div class="container-fluid">
            <div class="col-sm-4" id="date-div"></div>
            <script>
                var d = new Date();
                document.getElementById("date-div").innerHTML = d.toDateString();
            </script>
            <div class="col-sm-4" id="pagenames">Dashboard</div>
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
            <table class="table table-striped table-condensed table-responsive">
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width ="5%">Employee Code</th>
                        <th width ="10%">Name</th>
                        <th width ="5%">Status</th>
                        <th width ="5%">Open Incidents</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana">
                    
                    <tr> 
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr> 
                </tbody>
            </table>
            </div>
            <div class="col-sm-4">
                <table class="table table-striped table-condensed table-responsive">
                <thead style="color: darkblue; font-family:verdana">
                    <tr>
                        <th width ="15%">Client</th>
                        <th width ="5%">Open Incidents</th>
                    </tr>
                </thead>
                <tbody style="font-family:verdana">
                    
                    <tr> 
                        <td>test</td>
                        <td>test</td>
                    </tr> 
                </tbody>
            </table>
            </div>
        </div>
    </body>
</html>