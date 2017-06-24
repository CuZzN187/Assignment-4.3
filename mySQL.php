<?php

include "dbConnect.php";

function fInsertToDatabase($asin, $title, $price) {
	$myDB = fConnectToDatabase();
	if(!$asin){
		$sql = "INSERT INTO dvdActors (fname, lname) VALUES ('$title', '$price')";
	}else{
		$sql = "INSERT INTO dvdtitles (asin, title, price) VALUES ('$asin', '$title', $price)";
	}
	$stmt = $myDB->prepare($sql);
	$stmt->execute();
	//TODO fill in the rest of this function
}

function fDeleteFromDatabase($table, $asin) {
	$myDB = fConnectToDatabase();
	if($table == "dvdtitles"){
		$sql = "DELETE FROM $table WHERE asin='$asin'";
	}
	if($table == "dvdActors"){

		$sql = "DELETE FROM $table WHERE lname='$asin'";
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
	//TODO fill in the rest of this function
}