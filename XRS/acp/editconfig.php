<?php if(!defined("ACPPAGE")) exit(); ?>
<h1>:: Edit Configuration File ::</h1>
To verify that you are the administrator of the database, you must type your database's password below.<br><br>

<form method="POST">
<input name="DBpasswd" type="password"/> - <input type="submit" value="Check">
</form>

<?php
	if ( isset($_POST['DBpasswd']) )
	{
		if ( $_POST['DBpasswd'] == $dbpass )
		{
			
			$filename = 'config.php';
			if(isset($_POST['config']))
			{

				if (is_writable($filename)) {
				if (!$handle = fopen($filename, 'w')) {
					echo "<font color=\"red\">Unable to open the file (".$filename.").</font>";
					exit;
				}

				if (fwrite($handle, stripslashes($_POST['config'])) === FALSE) {
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
				
				<form method="post" action="acp.php?crk=editconfig">
				<input type="hidden" name="DBpasswd" value="<?php echo $dbpass; ?>"/>
				<textarea name="config" style="width:100%; height: 230px;">
				
				<?php
					echo htmlentities(file_get_contents($filename), ENT_QUOTES);
				?>
				
				</textarea><hr />
				<input type="submit" value="Edit" />
				</form>
				<?php
					}
		}
		else
		{
			echo '<font color="red">Wrong Password !</font>';
		}
	}	
?>