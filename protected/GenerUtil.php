<?php
	require_once 'config.php';
	$CONNECT = null;
	
	function getConnectByUser() {
		global $CONNECT;
		if ($CONNECT == null) {
			$CONNECT = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PWD,array(PDO::ATTR_PERSISTENT => true));
		}
		return $CONNECT;
	}
	
	function getNowRow() {
		$connect = getConnectByUser();
		$stmt = $connect->query("SELECT * FROM max_key");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['start'];
	}
	
	function generateResArray($connect,$max) {
		$res  = array();
		$stmt = $connect->query("SELECT * FROM content LIMIT ".$max.",-1");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
		} 
		return $res;
	}
	
	function changeTo($res) {
		
	}
	
	function getUpdateData($max) {
		$connect = getConnectByUser();
		if ($connect) {
			$res = generateResArray($connect,$max);
			return changeTo($res);
		}
		return null;
	}
	function publishContent($name,$content) {
		$connect = getConnectByUser();
		if ($name == null) {
			$name = '匿名';
		}
		if ($connect) {
			$stmt = $connect->prepare("INSERT INTO content(content_author,content_body) VALUES (:name,:body)");
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':body', $content);
			$stmt->execute();
		}
	}
?>