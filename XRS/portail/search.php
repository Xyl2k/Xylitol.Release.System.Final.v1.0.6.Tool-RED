<?php if(!defined('CONFIG')) exit(setup()); ?>
<h1>:: Search <?php echo $config['accro']; ?> Releases ::</h1>
<p>Our database contains a list of all our official releases. Use the
form below to search it.</p>


<?php
	$searchtype = "byname";
	if ( isset($_POST['searchtype']) AND $_POST['searchtype'] == "bycracker" )
		$searchtype = "bycracker";
	
	$ent = array ( "'" => ' ' );
	if (isset ( $_POST ['q'] ) && $_POST ['q'] != NULL)
	{
		$q			= htmlentities( $_POST ['q'] );
		$nobreak	= htmlentities(strtr ( $q, $ent ));
		
		$sql = "SELECT * FROM releases WHERE name LIKE '%$nobreak%' ORDER BY date DESC";
		if ( $searchtype == "bycracker" )
			$sql = "SELECT * FROM releases WHERE cracker LIKE '%$nobreak%' ORDER BY date DESC";
		
		$query			= mysql_query ($sql);
		$nb_resultats	= mysql_num_rows ( $query );
		
		if ($nb_resultats != 0)
		{
			echo '<p>Your search: "<font color="green"><b>', $q, '</b></font>" matched ';

			echo $nb_resultats , ($nb_resultats > 1) ? ' releases in our database!' : ' result';
			
			echo '<br /><br />';
	
			while ( $donnees = mysql_fetch_array ( $query ) )
			{
				echo '<a href="' . htmlentities ( $donnees ['url'] ) . '">' . htmlentities ( $donnees ['name'] ) . '</a> - ( Cracker : <font color="red">'.htmlentities( $donnees ['cracker'] ).'</font> )<br/>';
			}
	
			echo '<br /><br />';
	
			echo '<a href="index.php?crk=search">Make a new search</a></p>';
	
		}
		else
		{
?>
			<p>Your search: "<font color="red"><b><?php echo $q; ?></b></font>"
			matched 0 releases in our database!<br>
			<a href="index.php?crk=search">Click here if you want retry</a></p>
<?php
		}
	}
	else
	{
?>

	<form action="index.php?crk=search" method="post">
		<input id="textinput" class="textinput" name="q" value="XRS Search Engine" type="text" onclick="if(this.value=='XRS Search Engine')this.value = '';" onblur="if(this.value=='')this.value = 'XRS Search Engine'">
		<input class="submitbutton" name="submit" value="Perform Search" type="submit">
		<br><input type="radio" name="searchtype" value="byname" checked="checked"> Search by Release's Name
		<br><input type="radio" name="searchtype" value="bycracker"> Search by Cracker's Name
	</form>

<?php
	}



	