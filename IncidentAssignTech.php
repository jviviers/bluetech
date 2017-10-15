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

$incRef = $_GET['iid'];
$techID = $_GET['tid'];

$inc = new Incident("", "", "", "", "", "", "", "", "");
$inc->setIncidentProperties($incRef);
$department = $inc->getDepartment();
$inc->setTechnician($techID);
$inc->editIncident($incRef);

sleep(0);
header('location:Incidents.php?dep='.$department);
exit;


