<?php
		$user='root';//user
		$password='123';//password
		try{
			$db = new PDO('mysql:host=localhost;dbname=dd_collection;charset=utf8',$user,$password);//DBNAME
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
			}
		catch(PDOException $e){
			Print "ERROR!:". $e->getMessage();
			die();
		}
?>