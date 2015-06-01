<?php function connectionDB()
{
	try
	{
		$db = new PDO('mysql:host=;dbname=;charset=utf8', '','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $db;
	}
	catch(Exception $e)
	{
        die('Erreur : '.$e->getMessage());
	}
}
?>