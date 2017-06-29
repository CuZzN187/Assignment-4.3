<?php

include "mySQL.php";

//$asin = false;

echo "<!DOCTYPE html>
	<html><head>
	<title>Assignment 4.2</title></head>
	<body><p><H1>Robert De La Vega</H1></p>
	<p>Assignment 4.2</p><br>
	</body></html>";

/////////////////////////////////////////////////////////////////////////////////
//List Testing

echo "<H2>Initial Table with No Movies</H2><br>"; 

$table = "dvdtitles";

$stmt = fListFromDatabase($table);

echo "<H2>Initial Table with No Actors</H2><br>"; 

$table = "dvdActors";

$stmt = fListFromDatabase($table);

echo "<H2>Initial Table with No Joins</H2><br>"; 

$table = "dvdJoin";

$stmt = fListFromDatabase($table);

////////////////////////////////////////////////////////////////////////////////
//Insert Testing

//Insert Movies
$table = "dvdtitles";
echo "<br><H2>Add 4 Movies to Database</H2><br>";
//Dodgeball, Deadpool, MI4, Fast 8
$movieASINs = array("B00193F304", "B00VTDQJUM","B01BLS9EVA", "B06Y3KS6S9"); 
$movieNames = array("Dodgeball", "MI4", "Deadpool", "Fast 8");
$moviePrice = array(5.00, 10.77, 7.50, 14.99);
for ($x = 0; $x < 4; $x++)
{
	$stmt = fInsertToDatabase($movieASINs[$x], $movieNames[$x], $moviePrice[$x]);//add to dvdtitles
}

$stmt = fListFromDatabase($table);
//Insert Actors
$table = "dvdActors";
echo "<br><H2>Add 8 Actors to Database</H2><br>";
$actorFirst = array("Ben", "Vince", "Tom", "Jeremy", "Ryan", "Morena", "Vin", "Dwayne"); 
$actorLast = array("Stiller" ,"Vaughn", "Cruise", "Renner", "Reynolds", "Baccarin", "Diesel", "Johnson");
$asin = false;
for ($x = 0; $x < 8; $x++)
{
	$stmt = fInsertToDatabase($asin, $actorFirst[$x], $actorLast[$x]);
}

$stmt = fListFromDatabase($table);
//Insert into dvdJoin table
$joinASIN = array("B00193F304", "B00193F304", "B00VTDQJUM", "B00VTDQJUM", "B01BLS9EVA", "B01BLS9EVA", "B06Y3KS6S9", "B06Y3KS6S9");
$table = "dvdJoin";
$aee = xtra();
//insert into database for testing
for($x = 0; $x<8; $x++)
{
	$stmt = fInsertToDatabase($table, $joinASIN[$x], $aee[$x]);
}
$stmt = fListFromDatabase($table);

//////////////////////////////////////////////////////////////////////////////////////
//Delete Testing

//Join Table after above deletes
echo ("<H2>Delete MI4 from Relational Table and ALL OTHER RELATING TABLES</H2>");
$table1 = "dvdJoin";
$stmt = fDeleteFromDatabase($table1, "B00VTDQJUM"); //delete MI4
$stmt = fListFromDatabase($table1);


?>






