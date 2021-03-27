<?php

defined('CORE') or defined('CORE_ACP') or exit;

/**
 * Permet d'avoir une chaine sécurisé pour les inclusions.
 * @param $var la chaine à sécuriser
 * @return string
 */
function clean_var(string $var): string
{
    $var = trim($var);

    $pattern     = [ "([\40])" , "([^a-zA-Z0-9-])", "(-{2,})" ];
    $replacement = [ '-', '', '-' ];

    return preg_replace($pattern, $replacement, $var);
}

/**
 * Récupère la liste des fichiers / répertoires dans un array.
 * @param $directory le répertoire à analyser
 * @return array
 */
function directory_to_array($directory): array
{
	$files = array();

	if ($handle = opendir($directory))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file !== '.' && $file !== '..')
			{
				$file = $directory . '/' . $file;

				$files[] = preg_replace("/\/\//si", '/', $file);
			}
		}

		closedir($handle);
	}

	return $files;
}

function pageExists($page)
{
    return is_string($page) && in_array($page . '.php', scandir('portail'));
}

function setup(): void
{
	exit('<BODY BGCOLOR="#000000"><center><img src="install/xrs-black.jpg"></center><br /><font color="Green"><center><h1>Please go on the <a href="./install/install.php">Setup Page</a></h1></center></font></body>');
}

function generate_token(string $name): string
{
	$token = md5(uniqid(rand(), true));

	$_SESSION[$name . '_token']      = $token;
	$_SESSION[$name . '_token_time'] = time();

	return $token;
}

function check_token(string $name, $time, bool $get = true): bool
{
	if (isset($_SESSION[$name . '_token']) && isset($_SESSION[$name . '_token_time']))
	{
		$token = null;

		if ($get && isset($_GET['token']))
		{
			$token = $_GET['token'];
		}
		else if (!$get && isset($_POST['token']))
		{
			$token = $_POST['token'];
		}

		if (!is_null($token) && $_SESSION[$name . '_token'] === $token)
		{
			$old_timestamp = time() - $time;

			return ($_SESSION[$name . '_token_time'] >= $old_timestamp);
		}
	}

	return false;
}

function clean_token(): void
{
	if (isset($_SESSION['delete_token']))
	{
		unset($_SESSION['delete_token']);
	}
}

function clean_add_token(): void
{
	if (isset($_SESSION['add_token']))
	{
		unset($_SESSION['add_token']);
	}
}

function clean_edit_token(): void
{
	if (isset($_SESSION['edit_token']))
	{
		unset($_SESSION['edit_token']);
	}
}

function display($text, $entities = true)
{
	echo(($entities) ? htmlentities($text, ENT_QUOTES) : $text);
}

function get_banner()
{
	$banners = directory_to_array('design/banners');

	return $banners[mt_rand(0 , count($banners) - 1)];
}
