<?php 
	header("Context-type:text/html;charset=utf-8");
	include_once "dbconn.php";
	echo "<table border='1'>
	<tr>
	<th>Name</th>
	<th>Platform</th>
	<th>ID</th>
	<th>HyperLink</th>
	</tr>";
	$query=("select * from media");
	$stmt=$db->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	for($i=0;$i<count($result);$i++){
		echo "<tr>";
		echo "<td>".$result[$i]['Name']."</td>";
		echo "<td>".$result[$i]['Platform']."</td>";
		echo "<td>".$result[$i]['ID']."</td>";
		echo "<td>"."<a href='".$result[$i]['HyperLink']."' target='_blank'>".$result[$i]['HyperLink']."</a>"."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
?>