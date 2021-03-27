<?php

define('CORE', true);

require_once('libs/lib.php');

@include('config.php');

defined('CONFIG') or setup();

clean_token();
clean_add_token();

ob_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"  />
	<link rel="stylesheet" type="text/css" href="design/default.css" media="screen,projection" />
	<link rel="alternate" type="application/rss+xml" title="<?php display($config['team']); ?> Releases RSS Feed" href="rss.xml" />
	<link rel="shortcut icon" href="design/favicon.ico" />
	<title><?php display($config['team']); ?> &#1103;elease Portal</title>
</head>
<body>
	<div id="contentwrapper">
		<div id="banner">
			<img src="<?php echo(get_banner()); ?>" alt="Banner" />
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.php?crk=releases&spg=1">[ Latest &#1103;eleases ]</a></li>
				<li><a href="index.php?crk=search">[ Search Database ]</a></li>
				<li><a href="index.php?crk=about">[ About <?php display($config['accro']); ?> ]</a></li>
				<li><a href="rss.xml" target="_blank">[ RSS ]</a></li>
				<li><a href="acp.php">[ ACP ]</a></li>
			</ul>
		</div>
		<div id="maincontent">
			<?php
		
if(!empty($_GET['crk']))
{
    $page = clean_var($_GET['crk']);
    if (pageExists($page))
    {
        require_once('portail/' . $page . '.php');
    }
    else
    {
        require_once('bugslogger.php');
    }
}
else
{
    require_once('portail/releases.php');
}
			
			
			?>
		</div>
		<div id="footer">
			<p><?php display($config['team']); ?> &#1071;elease Portal v2.0.0</p>
			<p>&copy; <?php display(date('Y') . ' ' . $config['team']); ?></p>
		</div>
	</div>
</body>
</html>
<?php

ob_end_flush();
