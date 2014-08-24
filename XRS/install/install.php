<?php
@include("../config.php");
if(defined("CONFIG")) exit("<h2><font color=\"red\">Restricted Acces !</font></h2><p>If you are the administrator and if you want to Reinstall XRS, please go to the <a href=\"../acp.php\">Control Panel</a> and click on 'Unsinstall XRS'</p>");
	if(isset($_POST['team'], $_POST['accro'], $_POST['pass'], $_POST['path'], $_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['dbname']))
	{
		sleep(3);
		@mysql_connect($_POST['dbhost'],$_POST['dbuser'],$_POST['dbpass']);
		$select_base=@mysql_selectdb($_POST['dbname']);

		if (!$select_base)
			echo '<font color="red">ERROR - Database\'s Informations</font>';
		else
		{
			$query = file_get_contents('install.sql');
			mysql_query($query) or exit(mysql_error());
			

				$FileContent =  "<?php\r\n\r\n";
				$FileContent .= "define(\"CONFIG\", true);\r\n\r\n";
				$FileContent .= "\$config['team'] = '" . htmlentities( $_POST['team'] , ENT_QUOTES) . "';\r\n";
				$FileContent .= "\$config['pass'] = '" . htmlentities( $_POST['pass'] , ENT_QUOTES) . "';\r\n";
				$FileContent .= "\$config['accro'] = '" . htmlentities( $_POST['accro'] , ENT_QUOTES) . "';\r\n\r\n";
				$FileContent .= "\$config['path'] = '" . htmlentities( $_POST['path'] , ENT_QUOTES) . "';\r\n\r\n";
				$FileContent .= "\$config['cracksparpage'] = 20;\r\n\r\n";
				$FileContent .= "\$dbhost = '".$_POST['dbhost']."';\r\n";
				$FileContent .= "\$dbuser = '".$_POST['dbuser']."';\r\n";
				$FileContent .= "\$dbpass = '".$_POST['dbpass']."';\r\n";
				$FileContent .= "\$dbname = '".$_POST['dbname']."';\r\n\r\n";
				$FileContent .= "mysql_connect('" . htmlentities( $_POST['dbhost'] , ENT_QUOTES) . "', '" . htmlentities( $_POST['dbuser'] , ENT_QUOTES) . "', '" . htmlentities( $_POST['dbpass'] , ENT_QUOTES) . "');\r\n";
				$FileContent .= "mysql_select_db('" . htmlentities( $_POST['dbname'] , ENT_QUOTES) . "');";
				$FileContent .= "\r\n\r\n?>";
				
				$filename = "../config.php";
				
				if (is_writable($filename))
					unlink($filename);
				
				if (!$handle = fopen($filename, 'a')) {
					echo "<font color=\"red\">Unable to open the file (".$filename.").</font>";
					exit;
				}

				if (fwrite($handle, stripslashes($FileContent)) === FALSE) {
					echo "<font color=\"red\">Unable to write in the file (".$filename.").</font>";
					exit;
				}

				fclose($handle);
				
				echo '<font color="green">The installation was completed successfully !<br><a href="../index.php">Click here</a> for continue.</font>';
				
		}
	}
?>
<html>
<head>
	<title>Setup</title>
	<script>
		window.onload = function() {
			var str = window.location.href;
			str = str.replace("install/install.php","");
			document.getElementById('path').value = str;
		}
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-color: #000000;
}
body,td,th {
	color: #FFFFFF;
}
-->
</style></head>
<body>
<?php $nbimages=7;

$nomimages[1]="xrs1.jpg";
$nomimages[2]="xrs2.jpg";
$nomimages[3]="xrs3.jpg";
$nomimages[4]="xrs4.jpg";
$nomimages[5]="xrs5.jpg";
$nomimages[6]="xrs6.jpg";
$nomimages[7]="xrs7.jpg";
srand((double)microtime()*1000000);
$affimage=rand(1,$nbimages);
?>
<center><form action="install.php" method="post"><table width="697" border="0">
  <tr>
    <td><center><img src="<?php echo $nomimages[$affimage]; ?>" border=0></center>
	
		<fieldset>
			<legend>Team's Info</legend>
		<table width="450">
<tr>
				<td width="130">Team's name : </td>
			  <td width="308"><input name="team" type="text" id="team" size="50" /></td>
			</tr>
			<tr>
				<td>Team's acronym : </td>
				<td><input name="accro" type="text" id="accro" size="50" /></td>
			</tr>
			<tr>
				<td>Team's pass : </td>
				<td><input name="pass" type="password" id="pass" size="50" /></td>
			</tr>
			<tr>
				<td>Portal path : </td>
				<td><input name="path" type="text" id="path" size="50" /></td>
			</tr>
		</table>
		</fieldset>
		<fieldset>
			<legend>DataBase</legend>
		<table width="450">
	    <tr>
				<td width="128">Host </td>
			  <td width="310"><input name="dbhost" type="text" id="dbhost" value="localhost" size="50" /></td>
			</tr>
			<tr>
				<td>User : </td>
				<td><input name="dbuser" type="text" id="dbuser" size="50" /></td>
			</tr>
			<tr>
				<td>Password : </td>
				<td><input name="dbpass" type="password" id="dbpass" value="" size="50" /></td>
			</tr>
			<tr>
				<td>Database's Name : </td>
				<td><input name="dbname" type="text" id="dbname" size="50" /></td>
			</tr>
		</table>
		</fieldset>
		</td>
  </tr>
  <tr>
    <td><center><input value="Create your release system" type="submit" /></center></td>
  </tr>
</table></form>
</center>

</body>
</html>