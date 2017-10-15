<?php
/* 
 * Copyright (C) 2017 Jacques
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include 'Incident.php';
#Creating variables
$newStatus ="";
$reference ="";
#getting new status and setting to variable
if (isset($_GET['ref1'])){
    $reference = $_GET['ref1'];
    $newStatus = 'OnHold';
}
if (isset($_GET['ref2'])){
    $reference = $_GET['ref2'];
    $newStatus = 'Referred';
}
if (isset($_GET['ref3'])){
    $reference = $_GET['ref3'];
    $newStatus = 'Closed';
}
if (isset($_GET['ref4'])){
    $reference = $_GET['ref4'];
    $newStatus = 'Open';
}
#getting incident properties and sets new status and save
$inc = new Incident("", "", "", "", "", "", "", "", "");
$inc->setIncidentProperties($reference);
$department = $inc->getDepartment();
$inc->setStatus($newStatus);
$inc->editIncident($reference);

//exits to selected department incidents page    
sleep(0);
header('location:Incidents.php?dep='.$department);
exit;
