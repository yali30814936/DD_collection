<link rel="stylesheet" href="bootstrap.min.css">
<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	$Name=$_POST["Name"];
	$Platform=$_POST["Platform"];
	$ID=$_POST["ID"];
	$HyperLink=$_POST["HyperLink"];
	$query=("insert into media values(?,?,?,?)");
	$stmt=$db->prepare($query);
	try {
		$stmt->execute(array($Name,$Platform,$ID,$HyperLink));
		header("Location:inform3.php");
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "<br /><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
	}
?>