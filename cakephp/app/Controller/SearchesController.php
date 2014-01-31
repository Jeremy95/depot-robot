<?php

class SearchesController extends AppController{

	public $paginate = array(
		'limit' => 5,
		'order' => array('Search.titre asc') 
		);


	
	public function vue(){

		if($this->request->is('post')){

			$mot_cle = $this->request->data['Search']['search'];

			$keywords = $this->Search->find('all', array(
				'conditions' => array(
					'Search.keywords LIKE' => '%'.$mot_cle.'%',
					'Search.titre LIKE' => '%'.$mot_cle.'%',
					'Search.description LIKE' => '%'.$mot_cle.'%',
					'Search.url LIKE' => '%'.$mot_cle.'%')
				));

			if($keywords){

				$this->set(compact('keywords'));
			}
			else{

				echo "Aucun résultat ne correspond à votre recherche";
			}
			
		}
		
		
	}	

	public function index(){
		
	}

	public function robot(){

						try{
							$dns = 'mysql:host=localhost;dbname=cakephp';
							$utilisateur = 'root';
							$mdp = 'root';
							
							$options = array(
							PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
							
							$connexion = new PDO ($dns, $utilisateur, $mdp, $options);
						}
						
						catch(Exception $e){
							echo "Connexion SQL impossible; " ,$e->getMessage();
						die();
						}

						if(isset($_GET['site'])) {
						
							$site = $_GET['site'];
						
						}
						
						else {
						
							$site = 'http://jeuxvideos.com';
						
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

							
							
							
							$requete = $connexion->prepare("SELECT * FROM searches WHERE url='$site'");
							$requete->execute();
							$reponse = $requete->rowCount();
							
							if($reponse == 0) {
								
								$ps=0;
								$requete2 = $connexion->prepare("INSERT INTO 
									searches (url, titre, description, keywords, indexer) 
									VALUES (:site, :title, :description, :cle, :ps)");
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
									
									$requete_ = $connexion->prepare("UPDATE searches SET indexer = :indexer_ WHERE lien = :site");
									$requete_->bindParam(':indexer_', $indexer_, PDO::PARAM_INT);
									$requete_->bindParam(':site', $site, PDO::PARAM_STR);
									$requete_->execute();
								
								
									}
								}
							
							}
						}
						
						
						if(empty($lien[0])){
						
							echo'&bull; <font color="red">Aucun lien correspondant n\'a été trouvé.</font><br/>
							<form action="" method="GET"><input style="width:400px;" type="text" name="site" value="'.$site.'"/> 
							<input type="submit" value="OK" />
							</form>';
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
								setTimeout(\"window.location='robot?site=$_lien'\"); 
							</script>";
						}


	}

}






?>