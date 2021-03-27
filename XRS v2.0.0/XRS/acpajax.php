<?php

session_start();

define('CORE_ACP', true);

@require_once('config.php');
@require_once('libs/lib.php');

defined('CONFIG') or die;

if (isset($_SESSION['pass'], $_GET['id'], $_GET['token']) && ($_SESSION['pass'] == $config['pass']))
{
    require('acp/rss.php');

    $id = $_GET['id'];

    if (isset($_GET['delete']) && check_token('delete', 600))
    {
        $query = $db_link->prepare('DELETE FROM releases WHERE id = ?;');

		$query->execute([ $id ]);
    }
    else if (check_token('edit', 600))
    {
        if (isset($_GET['name'], $_GET['url'], $_GET['cracker']))
        {
            $name    = $_GET['name'];
            $url     = $_GET['url'];
            $cracker = $_GET['cracker'];

            $query = $db_link->prepare('UPDATE releases SET name = ?, url = ?, cracker = ? WHERE id = ?;');

            $query->execute([ $name, $url, $cracker ]);
        }
    }
}
