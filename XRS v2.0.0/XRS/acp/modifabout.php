<?php

defined('CORE_ACP') or exit;

$filename = 'libs/about.txt';

if (isset($_POST['about']))
{
	if (is_writable($filename))
	{
		file_put_contents($filename, stripslashes($_POST['about']));

		echo('Changes were done.');
	}
	else {
		echo('<font color="red">The file ' . $filename . ' is not accessible in writing.</font>');
	}
}

?>
<h1>:: About Modification ::</h1>
<form method="POST" action="acp.php?crk=modifabout">
	<p>HTML allowed</p>
	<textarea name="about" style="width:100%; height: 230px;"><?php display(file_get_contents($filename)); ?></textarea>
	<hr />
	<input type="submit" value="Modify" />
</form>
