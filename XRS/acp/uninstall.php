<?php if(!defined("ACPPAGE")) exit(); ?>
<h1>:: Uninstall XRS ::</h1>
<h4><font color="red">Do you really want to Uninstall XRS ?</font></h4>
To verify that you are the administrator of the database, you must type your database's password below.<br>

<form method="POST">
<input name="DBpasswd" type="password"/> - <input type="submit" value="Uninstall">
</form>

<?php
	if ( isset($_POST['DBpasswd']) )
	{
		if ( $_POST['DBpasswd'] == $dbpass )
		{
			$sql = "DROP TABLE `releases`";
			
			$about =  '<h1>:: About Our team ::</h1>';
			$about .= '<p>Our team are made up of a group of friends and reversers from around the world. We are here to have fun and make some quality releases.</p>';
			$about .= '<p>You cant contact us and we probably wont contact you. Have fun and keep on learning.</p>';
			$about .= '<p>"Life isnt about waiting for the storms to pass, its about learning to dance in the rain."</p>';
			
			mysql_query($sql);	

			require("rss.php");
			
			unlink("config.php");
			chdir("libs");
			unlink("about.txt");
			
			$handle = fopen("about.txt", "a");
			fputs($handle, $about);
			fclose($handle);
			
			echo '<font color="green">XRS has been Uninstalled...</font>';
		}
		else
		{
			echo '<font color="red">Wrong Password !</font>';
		}
	}
	
?>