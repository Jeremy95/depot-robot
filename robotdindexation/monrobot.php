<!DOCTYPE>


<?php

include('mysql.php');
include('function/function_log.php');


if(isset($_GET['site'])) {

	$site = $_GET['site'];
	
}

else {

	$site = 'http://www.google.fr';

}

	$code = file_get_contents($site);
	
	$code = preg_replace('!'.$site.'!isU', '', $code);
	preg_match('!<title>(.+)</title>!isU', $code, $title);
	preg_match_all('!http://[A-Za-z0-9][A-Za-z0-9\-\.]+[A-Za-z0-9]\.[A-Za-z]{2,}[\43-\176]*+!isU', $code, $lien);
	preg_match('!<meta name="description" content="(.+)"(.+)>!isU', $code, $description);
	preg_match('!<meta name="keywords" content="(.+)"(.+)>!isU', $code, $cle);
	
	$nb = count($lien[0]);

	if(empty($title) || empty($description) || empty($cle) || $title[0] == '' || $description[0] == '' || $cle[0] == '') {
	echo'&bull; <font color="red">Une des balises n\'est pas fournie.</font><br/><br/>';
	JEREM_log('ces sites ont une ou des balises manquantes : '.$site);
	
	}

		else
		{

			$title[0] = preg_replace('!<title>(.+)</title>!isU', '$1', $title[0]);
			$description[0] = preg_replace('!<meta name="description" content="(.+)"(.+)>!isU', '$1', $description[0]);
			$cle[0] = preg_replace('!<meta name="keywords" content="(.+)"(.+)>!isU', '$1', $cle[0]);
		
		
			echo'&bull; <font color="red">Meta title : </font> '.$title[0].'';
			echo'<br /><br />';
			echo'&bull; <font color="red">Meta description :</font> '.$description[0].'';
			echo'<br /><br />';
			echo'&bull; <font color="red">Meta keywords :</font> '.$cle[0].'<br/><br/>';
			JEREM_log('Le site suivant à était indexé :'.$site);
		
		
		
			$requete = $connexion->prepare("SELECT * FROM robots WHERE lien='$site'");
			$requete->execute();
			$reponse = $requete->rowCount();

			if($reponse == 0) {
				
				$ps=0;
				$requete2 = $connexion->prepare("INSERT INTO robots (lien, titre, description, keywords, indexer) VALUES (:site, :title, :description, :cle, :ps)");
				$requete2->bindParam(':title', $title[0], PDO::PARAM_STR);
				$requete2->bindParam(':description', $description[0], PDO::PARAM_STR);
				$requete2->bindParam(':site', $site, PDO::PARAM_STR);
				$requete2->bindParam(':cle', $cle[0], PDO::PARAM_STR);
				$requete2->bindParam(':ps', $ps, PDO::PARAM_INT);
				
				$requete2->execute();
				
				
			}

			else {
			
				$donnes = $requete->fetchAll();
				foreach ($donnes as $donnees) {
				
					if($site == $donnees['lien']) {
			
						echo $donnees['lien'];
					
						$indexer = $donnees['indexer'];
						$indexer_= $indexer+1;
						
						$requete_ = $connexion->prepare("UPDATE robots SET indexer = :indexer_ WHERE lien = :site");
						$requete_->bindParam(':indexer_', $indexer_, PDO::PARAM_INT);
						$requete_->bindParam(':site', $site, PDO::PARAM_STR);
						$requete_->execute();
						
						
					}
				}



			}
		}
		
			
if(empty($lien[0])){

	echo'&bull; <font color="red">Aucun lien correspondant n\'a été trouvé.</font><br/>
	<form action="" method="GET"><input type="text" name="site" value="'.$site.'" size="117" /> <input type="submit" value="OK" /></form>';
}
else {

	$aleatoire = rand(1, $nb);
	if($nb == 1){
	
		$aleatoire = $nb;
	}
	$_lien = $lien[0][$aleatoire];

echo'&bull; <font color="red">Lien suivant : </font> '.$_lien.'<br/><br/>';
echo'&bull; <font color="red">Nombre de liens : </font>'.$nb.'<br/><br/>';






echo"<script language=\"JavaScript\">
setTimeout(\"window.location='monrobot.php?site=$_lien'\"); 
</script>";



}

?>

<br/><br/>

<?php if(!empty($lien)) { ?>

<div align="center"><font style="color:green; font-family:Arial;"><strong>Chargement...</strong></font></div>

<?php } else { ?>

<div align="center"><font style="color:green; font-family:Arial;"><strong>Indexation stoppée...</strong></font></div>

<?php } ?>

<br ><div align="center"><a href="index.php" style="color:red; text-decoration:none">Relancer</a></div>
