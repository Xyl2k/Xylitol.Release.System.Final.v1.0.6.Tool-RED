<h1>::  About ::</h1>
<p>This CMS is made for all cracking crews, individuals, for all those who keep strugle the scene alive.<br />
  And mainly for all guys who are site operators and are not good at PHP coding (cheers my friends!)<br />
  I aimed for it because... nobody thought to make a release portal in CMS.<br />
  If you dont like the code/design just edit it, i have tryed to make the PHP more simple than possible, with no vulnerability problem, clean and light code etc...<br />
I hope you will enjoy my release system :)</p>
<p>Final words: i've made a CMS, that a first one for me, and that represent also alot of work, finally, thanks you for your interest on this.</p>
<p>__<br />
/Xylitol^RED</p>

<form method="post" action="acp.php?crk=sendmail">
<hr />
<h1>:: Contact form ::</h1>
<?php
	$ipi		= getenv ("REMOTE_ADDR");
	$httprefi	= getenv ("HTTP_REFERER");
	$httpagenti	= getenv ("HTTP_USER_AGENT");
?>
	<input type="hidden" name="ip"			value="<?php echo $ipi; ?>" />
	<input type="hidden" name="httpref"		value="<?php echo htmlentities($httprefi); ?>" />
	<input type="hidden" name="httpagent"	value="<?php echo htmlentities($httpagenti); ?>" />

<table width="389" border="0" cellspacing="0">
	<tr>
		<td width="103">Your Nick: </td>
		<td width="282"><input name="visitor" type="text" size="40" maxlength="20" /></td>
	</tr>
	<tr>
		<td>Your Email:</td>
		<td><input name="visitormail" type="text" size="40" maxlength="30" /></td>
	</tr>
	<tr>
		<td>Subject:</td>
		<td><select name="attn" size="1">
			<option value="I have found a bug in the CMS" selected>I have found a bug in the CMS</option>
			<option value="I need help with the script">I need help with the script</option>
			<option value="I just wanna says thank">I just wanna says thank</option>
			<option value="I just want drink a beer with you">I just want drink a beer with you</option>
			<option value="Other">Other</option>
			</select></td>
	</tr>
	<tr>
		<td>Mail Message: </td>
		<td><textarea name="notes" rows="4" cols="40"></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Send Mail" /></td>
	</tr>
</table>
</form>
<hr />
<h1>:: Greetings ::</h1>
<p>Alphabetically (A-Z) <br />
my spiritual family: Bispoo, BytePlayeR, Xspider.<br />
And individual: Encrypto, Hyperlisk (where are you bro?), Jowy, KPCR, MiSSiNG iN ByTES, Sheiry &amp; Trapcodien.<br />
</p>