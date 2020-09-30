<?php 
/*controleur c1.php :
  fonctions-action de gestion (c1)
*/

function ident() {
	$nom=  isset($_POST['nom'])?($_POST['nom']):'';
	$num=  isset($_POST['num'])?($_POST['num']):'';
	$mode= isset($_POST['mode'])?($_POST['mode']):'';
	$msg='';
	

	if  (count($_POST)==0)
              require ("./vue/utilisateur/ident.tpl") ;
    else {
	    if  (! verif_ident($nom,$num,$mode,$profil)) {
			$_SESSION['profil']=array();
			$msg ="Votre adresse e-mail ou votre mot de passe n'est pas valide";
	        require ("./vue/utilisateur/ident.tpl") ;
		}
		else if($mode=="etudiant"){ 
			$_SESSION['profil']= $profil;
			$url = "index.php?controle=Etudiant&action=accueil";
			header ("Location:" .$url) ;
			
			//$url = "accueil.php?no=$nom";
			//header ("Location:" .$url) ;	//echo ("ok, bienvenue"); 
		}else if ($mode=="professeur"){
			$_SESSION['profil']= $profil;
			$url = "index.php?controle=Professeur&action=accueil";
			header ("Location:" .$url) ;
		}
    }	
}

function verif_ident($nom,$num,$mode,&$profil) {
	require ('./modele/utilisateurBD.php');
	return verif_ident_BD($nom,$num,$mode,$profil); //true ou false en base;
}


function accueil() {
	$nom = $_SESSION['profil']['nom'];
	require ("./vue/utilisateur/accueil.tpl");
}

function liste_u() {
		require ('./modele/utilisateurBD.php');
		//.....;
}

?>
