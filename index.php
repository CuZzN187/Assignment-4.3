<?php

include "mySQL.php";

$asin = false;

echo "<!DOCTYPE html>
	<html><head>
	<title>Assignment 4.2</title></head>
	<body><p><H1>Robert De La Vega</H1></p>
	<p>Assignment 4.2</p><br>
	</body></html>";

echo "<H2>Initial Table with 1 Movie</H2><br>"; //DODGEBALL

$table = "dvdtitles";

$stmt = fListFromDatabase($table);

////////////////////////////////////////////////////////////////////////////////

echo "<br><H2>Add 3 Movies to Database</H2><br>";
//Deadpool, MI4, Fast 8
$movieASINs = array("B01BLS9EVA", "B00VTDQJUM", "B06Y3KS6S9"); 
$movieNames = array("Deadpool","MI4","Fast 8");
$moviePrice = array(10.77, 7.39, 19.96);
for ($x = 0; $x < 3; $x++)
{
	$stmt = fInsertToDatabase($movieASINs[$x], $movieNames[$x], $moviePrice[$x]);
}

$stmt = fListFromDatabase($table);

/////////////////////////////////////////////////////////////////////////////////

echo "<br><H2>Delete 2 Movies from Database</H2><br>";

for ($d = 1; $d < 3; $d++)
{
	$stmt = fDeleteFromDatabase($table, $movieASINs[$d]);
}

$stmt = fListFromDatabase($table);
//Reset Movie Table
$stmt = fDeleteFromDatabase($table, $movieASINs[0]);

/////////////////////////////////////////////////////////////////////////////////

echo "<H2>Initial Table with 2 Actors</H2><br>"; 

$table = "dvdActors";

$stmt = fListFromDatabase($table);// Ben Stiller and Vince Vaughn

////////////////////////////////////////////////////////////////////////////////

echo "<br><H2>Add 6 Actors to Database</H2><br>";

$actorFirst = array("Tom", "Jeremy", "Ryan", "Morena", "Vin", "Dwayne"); 
$actorLast = array("Cruise", "Renner", "Reynolds", "Baccarin", "Diesel", "Johnson");
for ($x = 0; $x < 6; $x++)
{
	$stmt = fInsertToDatabase($asin, $actorFirst[$x], $actorLast[$x]);
}

$stmt = fListFromDatabase($table);

/////////////////////////////////////////////////////////////////////////////////

echo "<br><H2>Delete 3 Actors from Database</H2><br>";

for ($dd = 3; $dd < 6; $dd++)
{
	$stmt = fDeleteFromDatabase($table, $actorLast[$dd]);
}

$stmt = fListFromDatabase($table);
//Reset Actors Table
for ($ddd = 0; $ddd < 3; $ddd++)
{
	$stmt = fDeleteFromDatabase($table, $actorLast[$ddd]);
}

?>






