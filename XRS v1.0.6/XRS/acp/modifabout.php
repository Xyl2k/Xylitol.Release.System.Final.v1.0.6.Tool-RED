<?php if(!defined("ACPPAGE")) exit(); ?>
<h1>:: About Modification ::</h1>
<?php
	$filename = 'libs/about.txt';
	if(isset($_POST['about']))
	{

		if (is_writable($filename)) {
			if (!$handle = fopen($filename, 'w')) {
				echo "<font color=\"red\">Unable to open the file (".$filename.").</font>";
				exit;
			}

			if (fwrite($handle, stripslashes($_POST['about'])) === FALSE) {
				echo "<font color=\"red\">Unable to write in the file (".$filename.").</font>";
				exit;
			}

			fclose($handle);
			
			echo 'Changes were done.';

		} else {
			echo "<font color=\"red\">The file ".$filename." is not accessible in writing.</font>";
		}

	}
	else
	{
?>
<form method="post" action="acp.php?crk=modifabout">
<p>HTML allowed</p>
<textarea name="about" style="width:100%; height: 230px;"><?php

	echo htmlentities(file_get_contents($filename), ENT_QUOTES);
?>
</textarea><hr />
<input type="submit" value="Modify" />
</form>
<?php
	}
?>