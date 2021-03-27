<?php

defined('CORE') or exit;

$releases      = null;
$releasesCount = 0;

$searchtype = 'byname';

if (isset($_POST['searchtype']) && $_POST['searchtype'] === 'bycracker')
{
	$searchtype = 'bycracker';
}

if (isset($_POST['q']) && is_string($_POST['q']) && strlen($_POST['q']) > 0)
{
	$q = $_POST['q'];

	if ($searchtype === 'bycracker')
	{
		$releases = $db_link->prepare('SELECT * FROM releases WHERE cracker LIKE ? ORDER BY date DESC;');
	}
	else
	{
		$releases = $db_link->prepare('SELECT * FROM releases WHERE name LIKE ? ORDER BY date DESC;');
	}

	$releases->execute([ '%' . $q . '%' ]);

	$releasesCount = $releases->rowCount();
}

?>
<h1>:: Search <?php display($config['accro']); ?> Releases ::</h1>
<?php if (!is_null($releases)) {
?>
<p>Your search: "<font color="<?php display(($releasesCount > 0) ? 'green' : 'red'); ?>"><b><?php display($q); ?></b></font>" matched <?php display($releasesCount . ($releasesCount > 1) ? ' releases in our database!' : ' result.'); ?>
<br /><br />
<?php
	if ($releasesCount != 0)
	{
		while ($release = $releases->fetch(PDO::FETCH_OBJ))
		{
			echo('<a href="' . htmlentities($release->url) . '">' . htmlentities ($release->name) . '</a> - ( Cracker : <font color="red">' . htmlentities($release->cracker) . '</font> )<br/>');
		}
?>
<br />
<a href="index.php?crk=search">Make a new search</a>
<?php
	} else {
?>
<a href="index.php?crk=search">Click here if you want retry</a>
<?php
	}
?>
</p>
<?php } else { ?>
<p>Our database contains a list of all our official &#1103;eleases. Use the form below to search it.</p>
<form action="index.php?crk=search" method="post">
	<input id="textinput" class="textinput" name="q" placeholder="XRS Search Engine" type="text">
	<input class="submitbutton" name="submit" value="Perform Search" type="submit">
	<br><input type="radio" name="searchtype" value="byname" checked="checked"> Search by &#1103;elease's Name
	<br><input type="radio" name="searchtype" value="bycracker"> Search by Cracker's Name
</form>
<?php } ?>
