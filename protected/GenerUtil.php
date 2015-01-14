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
		$now  = getNowRow();
		$tmp  = intval($now) - intval($max) + 1;
		$stmt = $connect->query("SELECT * FROM content LIMIT ".$max.",$tmp"); // 
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$res[] = $row;
		} 
		return $res;
	}
	
	function changeTo($res) {
		$str = "";
		foreach ($res as $tar) {
			$str = $str.$tar['content_author'] . ":" .
				   "<br />" . $tar['content_body'] .
				   "<hr />";
		}
		return $str;
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