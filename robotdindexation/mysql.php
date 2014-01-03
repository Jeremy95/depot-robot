<?php

try{
	$dns = 'mysql:host=localhost;dbname=bchiri';
	$utilisateur = 'bchiri';
	$mdp = '618143';
	
		$options = array(
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
						
		$connexion = new PDO ($dns, $utilisateur, $mdp, $options);
	}
	
	catch(Exception $e){
		echo "Connexion SQL impossible; " ,$e->getMessage();
		die();
	}
		
?>