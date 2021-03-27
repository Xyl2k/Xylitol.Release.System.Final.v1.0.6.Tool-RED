<?php

defined('CORE_ACP') or exit;

$today = date("r");
$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xml .= "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
$xml .= "  <channel>\n";
$xml .= "    <title>" . $config['accro'] . " Releases</title>\n";
$xml .= "    <description>Latest " . $config['accro'] . " Releases</description>\n";
$xml .= "    <copyright>" . $config['team'] . " 2018</copyright>\n";
$xml .= "    <link>" . $config['path'] . "</link>\n";
$xml .= "    <atom:link href=\"" . $config['path'] . "rss.xml\" rel=\"self\" type=\"application/rss+xml\"/>\n";
$xml .= "<language>en</language>\n";
$xml .= "    <image>\n";
$xml .= "      <title>" . $config['accro'] . " Releases</title>\n";
$xml .= "      <url>" . $config['path'] . "design/rss.png</url>\n";
$xml .= "      <link>" . $config['path'] . "</link>\n";
$xml .= "    </image>\n";

$today = date("D, d M Y H:i:s +0000");
$xml .= "<pubDate>" . $today . "</pubDate>\n";

$releases = $db_link->query('SELECT * FROM releases ORDER BY date DESC limit 0, 10');

while ($release = $releases->fetch(PDO::FETCH_OBJ))
{
	$titre   = $release->name;
	$adresse = $release->url;
	$date    = $release->date;
	$id      = $release->id;
	$objDate = new DateTime($date);
	$rssDate = $objDate->format(DateTime::RSS);
	
	$xml .= "    <item>\n";
	$xml .= "      <link>" . $config['path'] . "</link>\n";
	$xml .= "      <title>" . $titre . "</title>\n";
	$xml .= "      <description>Visit our portal for more information</description>\n";
	$xml .= "      <pubDate>" . $rssDate . "</pubDate>\n";
	$xml .= "      <guid>" . $config['path'] . "#" . $id . "</guid>\n";
	$xml .= "    </item>\n";
}

	$xml .= "  </channel>\n";
	$xml .= "</rss>\n";

file_put_contents('rss.xml', $xml);

?>
<br><br><p><font color="green">RSS Updated !</font></p><p><a href="rss.xml" target="_blank">Saw the file</a></p>
