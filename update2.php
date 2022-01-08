<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Company_name=$_POST["Company_name"];
	$Holding_company=$_POST["Holding_company"];
	if (empty($Holding_company)) $Holding_company=mysqli_query($db,"select Holding_company from company where Company_name= $Company_name");
	if ($Holding_company=="NULL") $Holding_company=NULL;
	$State=$_POST["State"];
	$query=("update company set Holding_company=?, State=? where Company_name=?");
	$stmt=$db->prepare($query);
	try {
		$stmt->execute(array($Holding_company,$State,$Company_name));
		header("Location:inform2.php");
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "<br /><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
	}
?>