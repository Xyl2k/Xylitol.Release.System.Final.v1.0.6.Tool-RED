
<p>You got a problem, we will redirect you on our main page<br />
We have logged your IP and your current url when you got this message for help us to identify the problem</p>
<?php
$referer = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : 'Unspecified';
if (strstr("Win", getenv("HTTP_USER_AGENT")))
  $os = "Windows";
elseif ((strstr(getenv("HTTP_USER_AGENT"), "Mac")) || (strstr(getenv("HTTP_USER_AGENT"), "PPC")))
  $os = "Mac";
elseif (strstr(getenv("HTTP_USER_AGENT"), "Linux"))
  $os = "Linux";
elseif (strstr(getenv("HTTP_USER_AGENT"), "FreeBSD"))
  $os = "FreeBSD";
elseif (strstr(getenv("HTTP_USER_AGENT"), "SunOS"))
  $os = "SunOS";
elseif (strstr(getenv("HTTP_USER_AGENT"), "IRIX"))
  $os = "IRIX";
elseif (strstr(getenv("HTTP_USER_AGENT"), "BeOS"))
  $os = "BeOS";
elseif (strstr(getenv("HTTP_USER_AGENT"), "OS/2"))
  $os = "OS/2";
elseif (strstr(getenv("HTTP_USER_AGENT"), "AIX"))
  $os = "AIX";
else
  $os = "Unknown";
$fp = fopen('logs.txt', 'a');
fwrite($fp, '+-[' . date('l jS \of F Y h:i:s A') . ']');
fwrite($fp, "\r\n");
fwrite($fp, '|');
fwrite($fp, "\r\n");
fwrite($fp, '|IP.................: ' . htmlentities($_SERVER["REMOTE_ADDR"]));
fwrite($fp, "\r\n");
fwrite($fp, '|User-Agent.........: ' . htmlentities($_SERVER["HTTP_USER_AGENT"]));
fwrite($fp, "\r\n");
fwrite($fp, '|OS.................: ' . $os);
fwrite($fp, "\r\n");
fwrite($fp, '|URi.Bugged.........: ' . htmlentities($_SERVER["REQUEST_URI"]));
fwrite($fp, "\r\n");
fwrite($fp, '|Variable.Bugged....: ' . htmlentities($_SERVER["QUERY_STRING"]));
fwrite($fp, "\r\n");
fwrite($fp, '|Accept-Language....: ' . htmlentities($_SERVER["HTTP_ACCEPT_LANGUAGE"]));
fwrite($fp, "\r\n");
fwrite($fp, '|Port...............: ' . htmlentities($_SERVER["REMOTE_PORT"]));
fwrite($fp, "\r\n");
fwrite($fp, '|Referer............: ' . htmlspecialchars("$referer"));
fwrite($fp, "\r\n");
fwrite($fp, "+----------------------------------------------------------------------------------");
fwrite($fp, "\r\n");
fclose($fp);
?>
<script type="text/javascript">
<!--
var obj = 'window.location.replace("index.php");';
setTimeout(obj,5000);
// -->
</script>