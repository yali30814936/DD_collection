<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Company_name=$_POST["Company_name"];
	$query=("delete from company where Company_name=?");
	$query2=("update virtual_youtuber set Company_name=NULL where Company_name=?");
	$stmt=$db->prepare($query);
	$stmt->execute(array($Company_name));
	$stmt2=$db->prepare($query);
	$stmt2->execute(array($Company_name));
	header("Location:inform2.php");
?>