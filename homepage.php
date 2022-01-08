<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="bootstrap.min.css">
<style>
	#demo{
		font-family: Microsoft JhengHei;
		font-size: 15px;
	}
	font{
		color:red;
	}
	input[type=checkbox] {
		visibility: hidden;
	}
	input[type="checkbox"]:checked {
		
	}
</style>                             
<head>
<title>DD收集庫</title>
</head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
<body>
	<?php include_once "dbconn.php"; ?>
	<div class="jumbotron text-center">
		<h2>DD收集庫</h2>
	</div>
	<div>
		<p name="login_word" style="float:left">error</p>
		<button name="login_btn" class="btn btn-info" onClick="self.location.href='logOut.php'">登出</button>
	</div>
	<div class="btn-group">
	  <button type="button" class="btn btn-primary" onclick="myfunction(1)">新增</button>
	  <button type="button" class="btn btn-primary" onclick="myfunction(2)">刪除</button>
	  <button type="button" class="btn btn-primary" onclick="myfunction(3)">修改</button>
	  <button type="button" class="btn btn-primary" onclick="myfunction(4)">查詢</button>
	  <div id="B">
	  </div>
	</div>
	<div id="demo"></div>
	<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
	<script>
		function myfunction(x){
			document.getElementById("demo").innerHTML="";
			if(x==1){
				document.getElementById("B").innerHTML=
				'<div class="btn-group"><button type="button" class="btn btn-success"onclick="add(1)">新增VTuber</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="add(2)">新增公司</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="add(3)">新增媒體</button>';
			}
			if(x==2){
				document.getElementById("B").innerHTML=
				'<div class="btn-group"><button type="button" class="btn btn-success"onclick="remove(1)">刪除VTuber</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="remove(2)">刪除公司</button>';
			}
			if(x==3){
				document.getElementById("B").innerHTML=
				'<div class="btn-group"><button type="button" class="btn btn-success"onclick="update(1)">修改VTuber資料</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="update(2)">修改公司資料</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="update(3)">修改媒體資料</button>';
			}
			if(x==4){
				document.getElementById("B").innerHTML=
				'<div class="btn-group"><button type="button" class="btn btn-success"onclick="search(1)">查詢VTuber個人資料</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="search(2)">查詢公司資料</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="search(3)">查詢媒體資料</button>'
				+'<div class="btn-group"><button type="button" class="btn btn-success"onclick="search(4)">查詢所有VTuber資料</button>';
			}
		}
		function add(x) {
		  if(x==1){
			  document.getElementById("demo").innerHTML = "<form action='add1.php' method='post'>"
			  +"Name:<input type='text' name='Name' required><font>必填</font><br>"
			  +"Company_name:<select name='Company_name'>"
				<?php  
					$query=("select Company_name from company");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=1;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Company_name']."\">";
						echo $result[$i]['Company_name'];
						echo "</option>";
					}
					echo "'";
				?>
			  +"<option value='NULL'>NULL</option></select><br>"
			  +"Group_name:<input type='text' name='Group_name'></input><br>"
			  +"Main_Language:<input type='text' name='Main_Language' required><font>必填</font><br>"
			  +"Sub_Language:<input type='text' name='Sub_Language'><br>"
			  +"State:<select name='State'><option value='活動中'>活動中</option>"
			  +"<option value='暫停活動'>暫停活動</option></select><br>"
			  +"<input type='submit' value='送出'></form>";
		  }
		  if(x==2){
			  document.getElementById("demo").innerHTML = "<form action='add2.php' method='post'>"
			  +"Company_name:<input type='text' name='Company_name' required><font>必填</font></input><br>"
			  +"Holding_company:<input type='text' name='Holding_company'></input><br>"
			  +"State:<select name='State'><option value='營運中'>營運中</option>"
			  +"<option value='停止營運'>停止營運</option></select><br>"
			  +"<input type='submit' value='送出'></form>";
		  }
		  if(x==3){
			document.getElementById("demo").innerHTML = "<form action='add3.php' method='post'>"
			+"Name:<select name='Name'>"
			<?php  
				$query=("select Name from virtual_youtuber where Name not in (select Name from media)");
				$stmt=$db->prepare($query);
				$stmt->execute();
				$result=$stmt->fetchAll();
				echo "+'";
				for($i=0;$i<count($result);$i++){
					echo "<option value=\"".$result[$i]['Name']."\">";
					echo $result[$i]['Name'];
					echo "</option>";
				}
				echo "'";
			?>
			+"</select><br>"
			+"Platform:<input type='text' name='Platform' value='Youtube' required><font>必填</font></input><br>"
			+"ID:<input type='text' name='ID' style='width:250px'required><font>必填</font></input><br>"
			+"HyperLink:<input type='text' name='HyperLink' style='width:500px' required><font>必填</font></input><br>"
			+"<input type='submit' value='送出'></form>";
		  }
		}
		function update(x){
			if(x==1){
				document.getElementById("demo").innerHTML = "<form action='update1.php' method='post'>"
				+"<font>預設為不修改 若要刪除此欄位請輸入NULL</font><br>"
				+"Name:<select name='Name'>"
				<?php  
					$query=("select Name from virtual_youtuber");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=0;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Name']."\">";
						echo $result[$i]['Name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"</select><br>"
				+"Company_name:<select name='Company_name'>"
				<?php  
					$query=("select distinct Company_name from virtual_youtuber");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=1;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Company_name']."\">";
						echo $result[$i]['Company_name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"<option value='NULL'>NULL</option></select><br>"
				+"Group_name:<input type='text' name='Group_name'></input><br>"
				+"Main_Language:<input type='text' name='Main_Language' required><font>必填</font><br>"
				+"Sub_Language:<input type='text' name='Sub_Language'></input><br>"
				+"State:<select name='State'><option value='活動中'>活動中</option>"
				+"<option value='暫停活動'>暫停活動</option></select><br>"
				+"<input type='submit' value='送出'></form>";
			}
			if(x==2){
				document.getElementById("demo").innerHTML = "<form action='update2.php' method='post'>"
				+"<font>預設為不修改 若要刪除此欄位請輸入NULL</font><br>"
				+"Company_name:<select name='Company_name'>"
				<?php  
					$query=("select Company_name from company");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=1;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Company_name']."\">";
						echo $result[$i]['Company_name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"</select><br>"
				+"Holding_company:<input type='text' name='Holding_company'></input><br>"
				+"State:<select name='State'><option value='營運中'>營運中</option>"
				+"<option value='停止營運'>停止營運</option></select><br>"
				+"<input type='submit' value='送出'></form>";
			}
			if(x==3){
				document.getElementById("demo").innerHTML = "<form action='update3.php' method='post'>"
				+"<font>預設為不修改 若要刪除此欄位請輸入NULL</font><br>"
				+"Name:<select name='Name'>"
				<?php  
					$query=("select Name from virtual_youtuber");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=0;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Name']."\">";
						echo $result[$i]['Name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"</select><br>"
				+"Platform:<input type='text' name='Platform' value='Youtube' required><font>必填</font></input><br>"
				+"ID:<input type='text' name='ID' style='width:250px'></input><br>"
				+"HyperLink:<input type='text' name='HyperLink' style='width:500px'></input><br>"
				+"<input type='submit' value='送出'></form>";
			}
		}
		function remove(x){
			if(x==1){
				document.getElementById("demo").innerHTML = "<form action='remove1.php' method='post'>"
				+"Name:<select name='Name'>"
				<?php  
					$query=("select Name from virtual_youtuber");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=0;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Name']."\">";
						echo $result[$i]['Name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"</select><br>"
				+"<input type='submit' value='送出'></form>";
			}
			if(x==2){
				document.getElementById("demo").innerHTML = "<form action='remove2.php' method='post'>"
				+"Company_name:<select name='Company_name'>"
				<?php 
					$query=("select Company_name from company");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=0;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Company_name']."\">";
						echo $result[$i]['Company_name'];
						echo "</option>";
					}
					echo "'";
				?>
				+"</select><br>"
				+"<input type='submit' value='送出'></form>";
			}
		}
		function search(x){
			if(x==1){
			  document.getElementById("demo").innerHTML = "<form action='inform5.php' method='post'>"
				+'<input list="VTubers" name="VTuber" id="VTuber" required><datalist id="VTubers">'
				<?php 
					$query=("select Name from virtual_youtuber");
					$stmt=$db->prepare($query);
					$stmt->execute();
					$result=$stmt->fetchAll();
					echo "+'";
					for($i=0;$i<count($result);$i++){
						echo "<option value=\"".$result[$i]['Name']."\">";
						echo $result[$i]['Name'];
						echo "</option>";
					}
					echo "'";
				?>
			  +"</datalist><input type='submit' value='查詢'></form>";
			}
			if(x==2){
			  document.getElementById("demo").innerHTML = "<form action='inform2.php' method='post'>"
			  +"<input type='submit' value='查詢'></form>";
			}
			if(x==3){
			  document.getElementById("demo").innerHTML = "<form action='inform3.php' method='post'>"
			  +"<input type='submit' value='查詢'></form>";
			}
			if(x==4){
			  document.getElementById("demo").innerHTML = "<form action='inform4.php' method='post'>"
			  +"<input type='submit' value='查詢'></form>";
			}
		}
		function start() {
			var name = "<?php
						if(isset($_SESSION['username']))
							echo $_SESSION['username'];?>";
			$("p[name=login_word").text("歡迎　" + name + "　");
		}
		window.addEventListener("load", start, false);
	</script>  
</body>
</html>