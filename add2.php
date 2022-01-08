<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Company_name=$_POST["Company_name"];
	$Holding_company=$_POST["Holding_company"];
	if (empty($Holding_company)) $Holding_company=NULL;
	$State=$_POST["State"];
	$query=("insert into company values(?,?,?)");
	$stmt=$db->prepare($query);
	try {
		$stmt->execute(array($Company_name,$Holding_company,$State));
		header("Location:inform2.php");
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "<br /><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
	}
?>