<?php
/*
XRS 2.0 beta API for release packers integration.
This file work standalone and can be renamed.
TODO: RSS update integration.

How to use:
This API is disabled by default because not everyone have their own release packager
or feel the need to use an API to automate the insertion process on their release portal.

Anyway, if you want to use it you must do some manual change on this file.
Edit this line:
$disable=false
replace it by $disable=true to enable the API.

You must change also the line
if($password!==md5('6_Suin6-qzZy4vmxyxT9'))
By another security password for the API (please use something strong as well)

You must also edit the mySQL db link:
$db=new PDO('mysql:host=localhost;dbname=xrs','root','');


The calling procedure work like this:
api.php?password=6_Suin6-qzZy4vmxyxT9&name=SomeApp&cracker=SomeGuy&url=http://releaselink.com

The API output is in JSON.

*/

	$disable=false; // for disabling api true for enable and false for disable


	if($disable===false)
	{
		$msg = array('Transaction'=>'Fail','Message'=>"Api is Disable");
        echo json_encode($msg);
       	exit;
	}

	if(!isset($_REQUEST['password']) || !isset($_REQUEST['name']) || !isset($_REQUEST['cracker']) || !isset($_REQUEST['url']))
	{
		$msg = array('Transaction'=>'Fail','Message'=>"Send All Mandatory Parameters");
        echo json_encode($msg);
       	exit;
	}
	
	$password=md5($_REQUEST['password']);
	$name=stripcslashes(htmlspecialchars(trim($_REQUEST['name'])));
	$cracker=stripcslashes(htmlspecialchars(trim($_REQUEST['cracker'])));
	$url=stripcslashes(htmlspecialchars(trim($_REQUEST['url'])));

	$now = new DateTime();
	$get_time= $now->format('Y-m-d H:i:s');
		
	if($password=="" || $name=="" || $cracker=="" || $url=="")
	{
		$msg = array('Transaction'=>'Fail','Message'=>"Fill out All Mandatory Fields");
        echo json_encode($msg);
       	exit;
	} 

	if($password!==md5('6_Suin6-qzZy4vmxyxT9'))
	{
		$msg = array('Transaction'=>'Fail','Message'=>"Password Don't Match");
        echo json_encode($msg);
       	exit;
	}	


	$db=new PDO('mysql:host=localhost;dbname=xrs','root','');
	$statement=$db->prepare("SELECT * from releases where name=:name");
	$statement->execute([
		':name'=>$name,
	]);
	$user = $statement->fetchAll(PDO::FETCH_OBJ);
		
	if($statement->rowCount()>0)
	{
		$msg = array('Transaction'=>'Fail','Message'=>'Name Already Exist in Database');
        echo json_encode($msg);
       	exit;
	}
	else
	{	
		$statement=$db->prepare("INSERT into releases(name,cracker,url,date) values(:name,:cracker,:url,:date)");
		$statement->execute([
			':name'=>$name,
			':cracker'=>$cracker,
			':url'=>$url,
			':date'=>$get_time
			]);
		$msg = array('Transaction'=>'Success','Message'=>'Values Inserted Successfully');
        echo json_encode($msg);
       	exit;
	}	
?>