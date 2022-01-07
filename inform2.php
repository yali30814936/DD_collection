<?php 
	header("Context-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	echo "<table border='1'>
	<tr>
	<th>Company_name</th>
	<th>Holding_company</th>
	<th>State</th>
	</tr>";
	$query=("select * from company");
	$stmt=$db->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	for($i=0;$i<count($result);$i++){
		echo "<tr>";
		echo "<td>".$result[$i]['Company_name']."</td>";
		echo "<td>".$result[$i]['Holding_company']."</td>";
		echo "<td>".$result[$i]['State']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
?>