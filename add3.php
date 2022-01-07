<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$Platform=$_POST["Platform"];
	$ID=$_POST["ID"];
	$HyperLink=$_POST["HyperLink"];
	$query=("insert into media values(?,?,?,?)");
	$stmt=$db->prepare($query);
	$stmt->execute(array($Name,$Platform,$ID,$HyperLink));
	header("Location:inform3.php");
?>