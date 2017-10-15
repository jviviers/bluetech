<?php
/*
 * Property of Jacques Viviers as part of the BlueTech System
 * Created for Deleting instances from blue DB tables.
 * @author Jacques Viviers jviviers007@gmail.com
 */
include 'ClientDB.php';
include 'TechnicianDB.php';
include 'DepartmentsDB.php';
include 'PartDB.php';
include 'TerminalDB.php';
include 'LocationDB.php';
include 'RetailSitesDB.php';
include 'Incident.php';

//Delete a Client from blue db
if (isset($_GET['ID'])){
    $db = new ClientDB();
    $clientid = $_GET['ID']; $db->deleteClient($clientid);
    sleep(0);
    header('location:Clients.php');
    exit;
}
//Delete a Part from Blue DB
if (isset($_GET['partnum'])){
    $db = new PartsDB();
    $part = $_GET['partnum']; $db->deletePart($part);
    sleep(0);
    header('location:Parts.php');
    exit;
}
//Delete a Technician from blue db
if (isset($_GET['code'])){
    $db = new TechnicianDB();
    $empCode = $_GET['code']; $db->deleteTech($empCode);
sleep(0);
header('location:Technicians.php');
exit;
}
//Delete a Terminal from blue db
if (isset($_GET['tid'])){
    $db = new TerminalDB();
    $ID = $_GET['tid']; $db->deleteTerminal($ID);
sleep(0);
header('location:Terminals.php');
exit;
}
//Delete a Department from blue db
if (isset($_GET['name'])){
    $db = new DepartmentsDB();
    $Name = $_GET['name']; $db->deleteDepartment($Name);
sleep(0);
header('location:Departments.php');
exit;
}
//Delete a Location from blue db
if (isset($_GET['city'])){
    $db = new LocationDB();
    $City = $_GET['city']; $db->deleteLocation($City);
sleep(0);
header('location:Locations.php');
exit;
}
//Delete a Incident from blue db
if (isset($_GET['IID'])){
    $db = new Incident(" ", " ", " ", " ", " ", " ", " ", " ", " ");
    $ID = $_GET['IID'];
    $db->setIncidentProperties($ID);
    $department = $db->getDepartment();
    $db->deleteIncident();
//exits to selected department incidents page    
sleep(0);
header('location:Incidents.php?dep='.$department);
exit;

}