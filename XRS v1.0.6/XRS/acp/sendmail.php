<?php
	$ip				= $_POST['ip'];
	$httpref		= $_POST['httpref'];
	$httpagent 		= $_POST['httpagent'];
	$visitor 		= $_POST['visitor'];
	$visitormail 	= $_POST['visitormail'];
	$notes 			= $_POST['notes'];
	$attn			= $_POST['attn'];

	$t4pz = '<p><a href="acp.php?crk=about">Go back!</a></p>';

	if (eregi('http:', $notes)) die ($t4pz);
	
	if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,".")))
	{
		echo "<h2>Use Back - Enter valid e-mail</h2>\n";
		echo "<h2>Feedback was NOT submitted</h2>\n";
		die ($t4pz);
	}

	if(empty($visitor) || empty($visitormail) || empty($notes ))
	{
		echo "<h2>Use Back - fill in all fields</h2>\n";
		die ("<p><a href='acp.php?crk=about'>Go back!</a></p>");
	}

	$todayis = date("l, F j, Y, g:i a");

	$subject = $attn;

	$notes = stripcslashes($notes);

$message = " $todayis [EST] \n
Subject: $attn \n
Message: $notes \n
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
Referral : $httpref \n
";

	$from = "From: $visitormail\r\n";

	mail("phoenixbytes@live.fr", $subject, $message, $from);

	//TODO fixer les XSS
?>
<html>
<body>
<div align="center">
	Date: <?php echo $todayis; ?>
	<br />
	Thank You : <?php echo htmlentities($visitor); ?> ( <?php echo htmlentities($visitormail); ?> )
	<br />
	
	Subject: <?php echo htmlentities($attn); ?>
	<br />
	Message:<br />
	<?php $notesout = str_replace("\r", "<br/>", $notes);
	echo htmlentities($notesout); ?>
	<br />
	<?php echo htmlentities($ip); ?>
	
	<br /><br />
	<p><a href="acp.php?crk=about">Go back!</a></p>
</div>
</body>
</html>
