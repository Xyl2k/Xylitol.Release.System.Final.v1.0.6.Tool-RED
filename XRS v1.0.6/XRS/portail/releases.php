<?php	
	if(!defined('CONFIG')) exit(setup());
	$crackerName	= (!empty($_GET['cracker'])) ? mysql_real_escape_string($_GET['cracker']) : '';

?><h1>Latest <?php echo $config['accro']; ?> Releases<br /><br />
	<?php if($crackerName != '') echo ' from ' , htmlentities($crackerName); ?>
</h1>
<?php
	echo '<p>Total releases :';

	$donnees = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS nb_entry FROM releases"));
	echo $donnees['nb_entry'];
	$totalCracks = $donnees['nb_entry'];

	if($crackerName != '')
	{
		$r = mysql_query("SELECT COUNT(*) AS nb_entry FROM releases WHERE cracker='" . $crackerName . "'");
		$donnees = mysql_fetch_array($r);
		echo '<br />Total releases of <b>' , htmlentities($crackerName) , '</b>: ' , $donnees['nb_entry'];
	}
	
	echo '</p>';
	
	$page = (isset($_GET['spg'])) ? (int)$_GET['spg'] : 1;
	$page = $page < 0 ? 0 : $page;
	//si on ne précise pas la page on va à la première page
	
	if($page != 0) $premierMessageAafficher = ($page - 1) * $config['cracksparpage'];
	
	$nombreDePages  = ceil($totalCracks / $config['cracksparpage']);
	
	echo '<span id="pagenums">Page : ';
	for ($i = 1 ; $i <= $nombreDePages ; $i++)
	{
		if($i != $page) echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?crk=releases&spg=' . $i . '">' . $i . '</a>';
		else echo $i . ' ';
	}
	echo '</span>';

?>
	<hr />
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td><center>Release name</center></td><td>Date (m/d/Y)</td><td>Cracker</td></tr>
<?php
	if($crackerName != '')
		$r = mysql_query("SELECT * FROM releases WHERE cracker='" . $crackerName . "' ORDER BY date DESC");
		
		
	elseif($page == 0)
		$r = mysql_query("SELECT * FROM releases");
	else
		$r = mysql_query("SELECT * FROM releases ORDER BY date DESC LIMIT $premierMessageAafficher, {$config['cracksparpage']}");

	while($donnees = mysql_fetch_array($r) )
	{
		echo '<tr>';
			echo '<td><a href="' . htmlentities($donnees['url']) , '">' , htmlentities($donnees['name']) , '</a></td>';
			echo '<td>' , date('m/d/Y', $donnees['date']) , '</td>';
			echo '<td><b><a href="index.php?crk=releases&cracker=' , htmlentities($donnees['cracker']) , '">' , htmlentities($donnees['cracker']) , '</a></b></td>';
		echo '</tr>';
	}

?></table>

<hr />
<div id="footerlinks">
	<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?crk=releases&spg=0"><font face="fixedsys" size="1">[All releases]</font></a>
</div>
