<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$query=("delete from virtual_youtuber where Name=?");
	$query2=("delete from media where Name=?");
	$stmt=$db->prepare($query);
	$stmt->execute(array($Name));
	$stmt2=$db->prepare($query2);
	$stmt2->execute(array($Name));
	header("Location:inform1.php");
?>