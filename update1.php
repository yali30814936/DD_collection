<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$Company_name=$_POST["Company_name"];
	if ($Company_name=="NULL") $Company_name=NULL;
	$Sub_Language=$_POST["Sub_Language"];
	if (empty($Sub_Language)) $Sub_Language=mysqli_query($db,"select Sub_Language from virtual_youtuber where Name= $Name");
	if ($Sub_Language=="NULL") $Sub_Language=NULL;
	$Group_name=$_POST["Group_name"];
	if (empty($Group_name)) $Group_name=mysqli_query($db,"select Group_name from virtual_youtuber where Name= $Name");
	if ($Group_name=="NULL") $Group_name=NULL;
	$State=$_POST["State"];
	$query=("update virtual_youtuber set Company_name=?, Group_name=?, Sub_Language=?, State=? where Name=?");
	$stmt=$db->prepare($query);
	$stmt->execute(array($Company_name,$Group_name,$Sub_Language,$State,$Name));
	header("Location:inform1.php");
?>