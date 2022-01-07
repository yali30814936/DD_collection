<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$ID=$_POST["ID"];
	if (empty($ID)) $ID=mysqli_query($db,"select ID from media where Name= $Name");
	if ($ID=="NULL") $ID=NULL;
	$HyperLink=$_POST["HyperLink"];
	if (empty($HyperLink)) $HyperLink=mysqli_query($db,"select HyperLink from media where Name= $Name");
	if ($HyperLink=="NULL") $HyperLink=NULL;
	$query=("update media set ID=?, HyperLink=? where Name=?");
	$stmt=$db->prepare($query);
	$stmt->execute(array($ID,$HyperLink,$Name));
	header("Location:inform3.php");
?>