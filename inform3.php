<link rel="stylesheet" href="bootstrap.min.css">
<?php 
	header("Context-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	echo "<table class='table'>
	<tr>
	<th>Name</th>
	<th>Platform</th>
	<th>ID</th>
	<th>HyperLink</th>
	</tr>";
	$query=("select * from media order by Name");
	$query2=("select COUNT(*) from media");
	$stmt=$db->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	$stmt2=$db->prepare($query2);
	$stmt2->execute();
	$result2=$stmt2->fetchAll();
	for($i=0;$i<count($result);$i++){
		echo "<tr>";
		echo "<td>".$result[$i]['Name']."</td>";
		echo "<td>".$result[$i]['Platform']."</td>";
		echo "<td>".$result[$i]['ID']."</td>";
		echo "<td>"."<a href='".$result[$i]['HyperLink']."' target='_blank'>".$result[$i]['HyperLink']."</a>"."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "資料數量:".$result2[0]['COUNT(*)']."筆";
	echo "<br><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
?>