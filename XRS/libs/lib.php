<?php
	/**
	 * Permet d'avoir une chaine sécurisé pour les inclusions.
	 * @param $var la chaine à sécuriser
	 * @return string
	 */
	//TODO conventionner le nom de la fonction
	function CleanVar($var)
	{
	    $var = trim($var);
	    $RemoveChars  = array( "([\40])" , "([^a-zA-Z0-9-])", "(-{2,})" );
	    $ReplaceWith = array("-", "", "-");
	    return preg_replace($RemoveChars, $ReplaceWith, $var);
	}
	
	/**
	 * Récupère la liste des fichiers / répertoires dans un array.
	 * @param $directory le répertoire à analyser
	 * @param $recursive boolean, si on doit parcourrir récursivement
	 * @return array
	 */
	function directoryToArray($directory, $recursive = false)
	{
		$array_items = array();
		if ($handle = opendir($directory))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != '.' && $file != '..')
				{
					if (is_dir($directory. '/' . $file))
					{
						if($recursive)
						{
							$array_items = array_merge($array_items, directoryToArray($directory. '/' . $file, $recursive));
						}
						$file = $directory . '/' . $file;
						$array_items[] = preg_replace("/\/\//si", '/', $file);
					}
					else
					{
						$file = $directory . "/" . $file;
						$array_items[] = preg_replace("/\/\//si", '/', $file);
					}
				}
			}
			closedir($handle);
		}
		return $array_items;
	}
	
	function setup()
	{
		exit('<BODY BGCOLOR="#000000"><font color="Green"><center><h1>Please go on the <a href="./install/install.php">Setup Page</a></h1></center></font></body>');
	}
	
	function generate_token($name)
	{
		$token = md5(uniqid(rand(), true));
		$_SESSION[$name.'_token'] = $token;
		$_SESSION[$name.'_token_time'] = time();
		return $token;
	}
	
	function check_token_post($name, $time)
	{
		if(isset($_SESSION[$name.'_token']) && isset($_SESSION[$name.'_token_time']) && isset($_POST['token']))
		{
			if($_SESSION[$name.'_token'] == $_POST['token'])
			{
				$old_timestamp = time() - $time;
				if($_SESSION[$name.'_token_time'] >= $old_timestamp)
					$return = true;
				else		
					$return = false;	
				
			}
			else
			{
				$return = false;
				}
			
		}
		else
			$return = false;	

		return $return;
	}
	
	function check_token_get($name, $time)
	{
		if(isset($_SESSION[$name.'_token']) && isset($_SESSION[$name.'_token_time']) && isset($_GET['token']))
		{
			if($_SESSION[$name.'_token'] == $_GET['token'])
			{
				$old_timestamp = time() - $time;
				if($_SESSION[$name.'_token_time'] >= $old_timestamp)
					$return = true;
				else		
					$return = false;	
				
			}
			else
				$return = false;	
			
		}
		else
			$return = false;	

		return $return;
	}

	function clean_token()
	{
		$_SESSION['delete_token'] = "";
		$_SESSION['edit_token'] = "";
	}
	
	function clean_add_token()
	{
		$_SESSION['add_token'] = "";
	}