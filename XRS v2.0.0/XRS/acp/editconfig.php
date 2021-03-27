<?php

defined('CORE_ACP') or exit;

if (isset($_POST['DBpasswd']))
{
	if ($_POST['DBpasswd'] === $dbpass)
	{
		$filename = 'config.php';

		if (isset($_POST['config']))
		{
			if (is_writable($filename))
			{
				file_put_contents($filename, stripslashes($_POST['config']));

				echo('Changes were done.');
			}
			else
			{
				echo('<font color="red">The file ' . $filename . ' is not accessible in writing.</font>');
			}

		}
		else
		{
?>
<form method="post" action="acp.php?crk=editconfig">
	<input type="hidden" name="DBpasswd" value="<?php display($dbpass); ?>"/>
	<textarea name="config" style="width:100%; height: 230px;"><?php display(file_get_contents($filename)); ?></textarea><hr />
	<input type="submit" value="Edit" />
</form>
<?php
		}
	}
	else
	{
		echo('<font color="red">Wrong Password!</font>');
	}
}
?>
<h1>:: Edit Configuration File ::</h1>
To verify that you are the administrator of the database, you must type your database's password below.<br><br>
<form method="POST">
	<input name="DBpasswd" type="password"/> - <input type="submit" value="Check">
</form>
