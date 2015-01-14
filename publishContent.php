<?php
require_once 'protected/config.php';
require_once 'protected/GenerUtil.php';

if (!isset($_GET['name'])) {
	$_GET['name'] = "";
}

publishContent($_GET['name'], $_GET['content']);

?>