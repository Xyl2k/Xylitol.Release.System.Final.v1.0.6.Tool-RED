<?php
	if(!defined("ACPPAGE")) exit();
	
	if ( !isset($_POST['token']) )
	{
		$token = generate_token("add");
	}
	
	if(isset( $_POST['releasename'], $_POST['url'], $_POST['cracker']) AND !empty($_POST['releasename']) AND !empty($_POST['url']) AND !empty($_POST['cracker']) )
	{
		if ( check_token_post("add", 600) )
		{
			$query	= 'INSERT INTO releases (name, url, cracker, date) VALUES('
				. '\'' . mysql_real_escape_string($_POST['releasename']) . '\', '	//releases.name
				. '\'' . mysql_real_escape_string($_POST['url']) . '\', '			//releases.url
				. '\'' . mysql_real_escape_string($_POST['cracker']) . '\', '		//releases.cracker
				. time() . ')';														//releases.date
					
			mysql_query($query);
			
			$token = generate_token("add");
			
			echo '<font color="green">Release added.</font>';
			include('rss.php');
		}
		else
		{
			echo '<font color="red">Invalid Token !<br>Please try again.</font>';
		}
	}
		
?><h1>:: Add a new &#1103;elease ::</h1>
<hr />
<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?crk=addrelease" method="post">
	<table cellpadding="4" cellspacing="0">
		<tr>
			<td><div align="right">Application name:</div></td>
			<td><input type="text" name="releasename" size="60" /></td>
		</tr>
		<tr>
			<td><div align="right">Release link: </div></td>
			<td><input type="text" name="url" size="60" /></td>
		</tr>
		<tr>
			<td><div align="right">Cracker : </div></td>
			<td><input type="text" name="cracker" /></td>
		</tr>
		<tr>
			<td><div align="right"><input type="submit" value="Submit" /></div></td>
			<td></td>
		</tr>
	</table>
<input type="hidden" name="token" value="<?php echo $token; ?>"/>
</form>
