<?php
require_once 'protected/config.php';
require_once 'protected/GenerUtil.php';

$max = $_SESSION['max'];
$_SESSION['max'] = getNowRow();
if ($max == $_SESSION['max']) {
	echo "";
} else { 
  echo getUpdateData($max);
}
?>