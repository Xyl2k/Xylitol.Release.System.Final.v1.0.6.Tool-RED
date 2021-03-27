<?php
	session_start();
	@require_once 'config.php';
	@require_once 'libs/lib.php';
	if(!defined("CONFIG")) exit();
	
	if(isset($_SESSION['pass'], $_GET['name'], $_GET['url'], $_GET['cracker'], $_GET['id'], $_GET['token']) && ($_SESSION['pass'] == $config['pass']) )
	{
		require("acp/rss.php");
		
		if ( isset($_GET['delete']) AND check_token_get("delete", 600) )
			mysql_query("DELETE FROM releases WHERE id='".$_GET['id']."'");
		else if (check_token_get("edit", 600))
			mysql_query('UPDATE releases SET name=\'' . mysql_real_escape_string($_GET['name']) . '\', url=\'' . mysql_real_escape_string($_GET['url']) . '\', cracker=\'' . mysql_real_escape_string($_GET['cracker']) . '\' WHERE id=' .  (int)$_GET['id']) ;
	}