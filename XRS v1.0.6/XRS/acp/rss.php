<?php

	$xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
	$xml .= "<?xml-stylesheet type=\"text/xsl\" href=\"rss_style.xsl\"?>\n";
	$xml .= "<rss version=\"2.0\">\n";
	$xml .= "<channel>\n";
	$xml .= "<title>" . $config['accro'] . " Releases</title>\n";
	$xml .= "<link>" . $config['path'] . "</link>\n";
	$xml .= "<description>Latest " . $config['accro'] . " Releases</description>\n";
	$xml .= "<copyright> " . $config['team'] . " 2009</copyright>\n";
	$xml .= "<language>en</language>\n";
	$xml .= "<image>\n";
	$xml .= "<title> " .  $config['accro'] . " Releases</title>\n";
	$xml .= "<url>" . $config['path'] . "design/rss.png</url>\n";
	$xml .= "<link>" . $config['path'] . "</link>\n";
	$xml .= "</image>\n";
	$today = date("D, d M Y H:i:s +0100");
	//date du jour d'execution du fichier PHP
	$xml .= "<pubDate>" . $today . "</pubDate>\n";
	// Faîtes appel à vos fichier de connection à votre base de donnée MySQL
	// Adaptez ces lignes à votre base de données / noms de table
	$resultat_requete = mysql_query("SELECT * FROM releases ORDER BY date DESC limit 0, 10");
	// extraction des 10 dernières releases
	while ($lig = @mysql_fetch_assoc($resultat_requete))
	{
		$titre = $lig["name"];
		$adresse = $lig["url"];
		$date = $lig["date"];
		$datephp = date("D, d M Y H:i:s +0100", $date);
		$xml .= "<item>\n";
		$xml .= "<title>" . $titre . "</title>\n";
		$xml .= "<link>" . $config['path'] . "</link>\n";
		$xml .= "<pubDate>" . $datephp . "</pubDate>\n";
		$xml .= "<description>Visit our distro to download</description>\n";
		$xml .= "</item>\n";
	} //fin du while
	$xml .= "</channel>\n";
	$xml .= "</rss>\n";
	$fp = fopen("rss.xml", 'w+');
	fputs($fp, $xml);
	fclose($fp);
	echo '<br><br><p><font color="green">RSS Updated !</font></p><p><a href="rss.xml">Saw the file</a></p>';
?>