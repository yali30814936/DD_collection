<link rel="stylesheet" href="bootstrap.min.css">
<?php 
	header("Context-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	echo "<table class='table'>
	<tr>
	<th>Name</th>
	<th>Company_name</th>
	<th>Group_name</th>
	<th>Main_Language</th>
	<th>Sub_Language</th>
	<th>State</th>
	</tr>";
	$query=("select * from virtual_youtuber order by Company_name,Group_name");
	$query2=("select COUNT(*) from virtual_youtuber");
	$stmt=$db->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	$stmt2=$db->prepare($query2);
	$stmt2->execute();
	$result2=$stmt2->fetchAll();
	for($i=0;$i<count($result);$i++){
		echo "<tr>";
		echo "<td>".$result[$i]['Name']."</td>";
		echo "<td>".$result[$i]['Company_name']."</td>";
		echo "<td>".$result[$i]['Group_name']."</td>";
		echo "<td>".$result[$i]['Main_Language']."</td>";
		echo "<td>".$result[$i]['Sub_Language']."</td>";
		echo "<td>".$result[$i]['State']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "資料數量:".$result2[0]['COUNT(*)']."筆";
	echo "<br><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
?>
