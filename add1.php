<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$Company_name=$_POST["Company_name"];
	if ($Company_name=="NULL") $Company_name=NULL;
	$Group_name=$_POST["Group_name"];
	if (empty($Group_name)) $Group_name=NULL;
	$Main_Language=$_POST["Main_Language"];
	$Sub_Language=$_POST["Sub_Language"];
	if (empty($Sub_Language)) $Sub_Language=NULL;
	$State=$_POST["State"];
	$query=("insert into virtual_youtuber values(?,?,?,?,?,?)");
	$stmt=$db->prepare($query);
	$stmt->execute(array($Name,$Company_name,$Group_name,$Main_Language,$Sub_Language,$State));
	header("Location:inform1.php");
?>