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
	<th>Platform</th>
	<th>ID</th>
	<th>HyperLink</th>
	</tr>";
	$VTuber=$_POST["VTuber"];
	$query=("select * from virtual_youtuber, media where virtual_youtuber.Name=media.Name and virtual_youtuber.Name=?");
	$stmt=$db->prepare($query);
	$stmt->execute(array($VTuber));
	$result=$stmt->fetchAll();
	for($i=0;$i<count($result);$i++){
		echo "<tr>";
		echo "<td>".$result[$i]['Name']."</td>";
		echo "<td>".$result[$i]['Company_name']."</td>";
		echo "<td>".$result[$i]['Group_name']."</td>";
		echo "<td>".$result[$i]['Main_Language']."</td>";
		echo "<td>".$result[$i]['Sub_Language']."</td>";
		echo "<td>".$result[$i]['State']."</td>";
		echo "<td>".$result[$i]['Platform']."</td>";
		echo "<td>".$result[$i]['ID']."</td>";
		echo "<td>".$result[$i]['HyperLink']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br><input type='button' onclick='window.location.replace(document.referrer)' value='返回首頁'></input>";
?>
