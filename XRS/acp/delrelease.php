<?php
	if(!defined("ACPPAGE")) exit();
	$crackerName	= (isset($_GET['cracker'])) ? mysql_real_escape_string($_GET['cracker']) : '';	
	
	$token = generate_token("delete");
?>
	<h1><span class="Style1">:: Delete <?php echo $config['accro']; ?> &#1103;eleases ::<br /><br /></span><?php if($crackerName != '') echo ' from ' . htmlentities($crackerName); ?></h1>
	<p>Total releases :
	<?php
		$donnees = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS nb_entry FROM releases"));
		echo $donnees['nb_entry'];
		$totalCracks = $donnees['nb_entry'];

		if($crackerName != '')
		{
			$r = mysql_query("SELECT COUNT(*) AS nb_entry FROM releases WHERE cracker='" . $crackerName . "'");
			$donnees = mysql_fetch_array($r);
			echo '<br />Total releases of <b>' . htmlentities($crackerName) . '</b>: ' . $donnees['nb_entry'];
		}
	?></p>
<center><?php
	$page = (isset($_GET['spg'])) ? (int)$_GET['spg'] : 1;
	$page = $page < 0 ? 0 : $page;
	
	if($page != 0) $premierMessageAafficher = ($page - 1) * $config['cracksparpage'];
	
	$nombreDePages  = ceil($totalCracks / $config['cracksparpage']);
	
	echo '<span id="pagenums">Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++)
	{
		if($i != $page) echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?crk=delrelease&spg=' . $i . '">' . $i . '</a>';
		else echo $i . ' ';
	}
	echo '</span>';

?></center>
	<hr />
	<form>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td><center>Release name</center></td><td><center>url</center></td><td>Date (m/d/Y)</td><td>Cracker</td>
		<td>Delete</td>
		</tr>
<?php
	if($crackerName != '')
		$r = mysql_query("SELECT * FROM releases WHERE cracker='" . $crackerName . "' ORDER BY date DESC");
	elseif($page == 0)
		$r = mysql_query("SELECT * FROM releases");
	else
		$r = mysql_query("SELECT * FROM releases ORDER BY date DESC LIMIT $premierMessageAafficher, {$config['cracksparpage']}");

	while($donnees = mysql_fetch_array($r) )
	{
		echo '<input type="hidden" id="token" value="'.$token.'"/>';
		echo '<tr id="hide'.$donnees['id'].'">';
			echo '<td><input id="name' , $donnees['id'] , '" class="acpinput" type="text" value="' , htmlentities($donnees['name']) , '" onkeypress="change(' , $donnees['id'] , ');" disabled/></span></td>';
			echo '<td><input id="url' , $donnees['id'] , '" class="acpinput" type="text" value="' ,  htmlentities($donnees['url']) , '" onkeypress="change(' , $donnees['id'] , ');" disabled/></td></span>';
			echo '<td>' , date('m/d/Y', $donnees['date']) , '</td></span>';
			echo '<td><input id="cracker' , $donnees['id'] , '" class="acpinput" type="text" value="' , htmlentities($donnees['cracker']) , '" onkeypress="change(' , $donnees['id'] , ');" disabled/></td></span>';
			echo '<td><span id="sure' , $donnees['id'] , '" style="display:none">Sure ?<br><input type="button" value="YES" id="button' , $donnees['id'] , '" onclick="delrowsure(' , $donnees['id'] , '); return false;" /> <input type="button" value="NO" id="button' , $donnees['id'] , '" onclick="notsure(' , $donnees['id'] , '); return false;" /> </span><span id="update' , $donnees['id'] , '"><input type="button" value="delete" id="button' , $donnees['id'] , '" onclick="delrow(' , $donnees['id'] , '); return false;" /></span></td>';
		echo '</tr>';
	}
?>
	</table>
	</form>
<hr />
