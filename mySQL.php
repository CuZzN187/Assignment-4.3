<?php

include "dbConnect.php";

function fInsertToDatabase($asin, $title, $price) {
	$myDB = fConnectToDatabase();
	if(!$asin){//$asin passed in as a false boolean to default to dvdActors table
		$sql = "INSERT INTO dvdActors (fname, lname) VALUES ('$title', '$price')";
		$stmt = $myDB->prepare($sql);
		$stmt->execute();
	}elseif($asin == "dvdJoin"){
		$sql = "INSERT INTO dvdJoin (asin, actorID) VALUES ('$title', $price)";
		$stmt = $myDB->prepare($sql);
		$stmt->execute();
	}else{
		$sql = "INSERT INTO dvdtitles (asin, title, price) VALUES ('$asin', '$title', $price)";
		$stmt = $myDB->prepare($sql);
		$stmt->execute();
	}
	
	//TODO fill in the rest of this function
}

function fDeleteFromDatabase($table, $asin) {
	$myDB = fConnectToDatabase();
	if($table == "dvdtitles"){
		$sql = "DELETE FROM $table WHERE asin='$asin'"; 
	} 	
	if($table == "dvdActors"){
		$sql = "DELETE FROM $table WHERE actorID='$asin'";
	}
	if($table == "dvdJoin"){
		$stmt = $myDB->prepare("SELECT tt.asin, a.actorID FROM CS3620.dvdtitles tt INNER JOIN CS3620.dvdJoin i ON tt.asin = i.asin INNER JOIN 
		CS3620.dvdActors a ON a.actorID = i.actorID WHERE tt.asin = '$asin'");
		$stmt->execute();
		while($row = $stmt->fetch()){
			$sql = "DELETE FROM $table WHERE asin = '$row[0]'";
			$sql1 = "DELETE FROM dvdtitles WHERE asin = '$row[0]'";
			$sql2 = "DELETE FROM dvdActors WHERE actorID = '$row[1]'";
			print_r($row[0]." ");
			echo ("success!");
			echo "<br>";
		}
		$stmt = $myDB->prepare($sql1);
		$stmt->execute();
		$stmt = $myDB->prepare($sql2);
		$stmt->execute();
	}
	$stmt = $myDB->prepare($sql);
	$stmt->execute();
	//TODO fill in the rest of this function
}

function fListFromDatabase($table) {
	$myDB = fConnectToDatabase();
	if($table == "dvdtitles"){
		$stmt = $myDB->prepare("SELECT asin FROM dvdtitles");
		$stmt->execute();
		while($row = $stmt->fetch()){
			$url = 'http://images.amazon.com/images/P/'.$row[0].'.01.MZZZZZZZ.jpg';
			echo('<!DOCTYPE html><html><head><title>title</title></head><body><td><img src="'.$url.'"</td><br></body></html>');
		}
		return $stmt;
	}
	if($table == "dvdActors"){
		$stmt = $myDB->prepare("SELECT fname, lname, actorID FROM dvdActors");
		$stmt->execute();
		while($row = $stmt->fetch()){
			print_r($row[2]."-".$row[0]." ".$row[1]);
			echo "<br>";
		}
		return $stmt;
	}
	if($table == "dvdJoin"){
		$stmt = $myDB->prepare("SELECT asin, actorID FROM dvdJoin");
		$stmt->execute();
		while($row = $stmt->fetch()){
			print_r($row[0]." ".$row[1]);
			echo "<br>";
		}
		return $stmt;
	}
	//TODO fill in the rest of this function
}

function fJoinFromDatabase($asin){
	$myDB = fConnectToDatabase();
	$stmt = $myDB->prepare("SELECT tt.asin, a.actorID FROM CS3620.dvdtitles tt INNER JOIN CS3620.dvdJoin i ON tt.asin = i.asin INNER JOIN 
		CS3620.dvdActors a ON a.actorID = i.actorID");
	$stmt->execute();
	while($row = $stmt->fetch()){
			print_r($row[0]." ".$row[1]." ");
			echo "<br>";
			//$url = 'http://images.amazon.com/images/P/'.$row[0].'.01.MZZZZZZZ.jpg';
			//echo('<!DOCTYPE html><html><head><title>title</title></head><body><td><img src="'.$url.'"</td><br></body></html>');
		}
		return $stmt;
}

function xtra(){
	$myDB = fConnectToDatabase();
	$stmt = $myDB->prepare("SELECT actorID FROM dvdActors");
	$stmt->execute();
	$test = array();
	echo ("<h2>Add 8 Records to Relational Database</h2>");
	while($row = $stmt->fetch()){
			array_push($test, $row[0]);
		}
	return $test;
}