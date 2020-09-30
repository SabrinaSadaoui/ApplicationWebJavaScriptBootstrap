<?php 
/*Fonctions-modèle réalisant la gestion d'une table de la base,
** ou par extension gérant un ensemble de tables. 
** Les appels à ces fcts se fp,t dans c1.
*/

	//echo ("Penser à modifier les paramètres de connect.php avant l'inclusion du fichier <br/>");
	//require ("modele/connect.php") ; //connexion MYSQL et sélection de la base, $link défini
	

function verif_ident_BD($nom,$num,$mode,&$profil){ 
	require ("modele/connect.php") ; 
	//global $pdo;
	$sql_etu="SELECT * FROM `etudiant`      where  login_etu=:nom and pass_etu=:num";
	$sql_prof="SELECT * FROM `professeur` 	where login_prof=:nom and pass_prof=:num";
	$res_etu= array(); 
	$res_prof= array(); 
	
	try {
		$cde_etu = $pdo->prepare($sql_etu);
		$cde_etu->bindParam(':nom', $nom);
		$cde_etu->bindParam(':num', $num);
		$b_etu = $cde_etu->execute();
		
		$cde_prof = $pdo->prepare($sql_prof);
		$cde_prof->bindParam(':nom', $nom);
		$cde_prof->bindParam(':num', $num);
		$b_prof = $cde_prof->execute();
		
		if (($b_etu)&&($b_prof)) {
			$res_etu = $cde_etu->fetchAll(PDO::FETCH_ASSOC); //tableau d'enregistrements
			$res_prof= $cde_prof->fetchAll(PDO::FETCH_ASSOC); //tableau d'enregistrements
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
	
	if ((count($res_etu)> 0) && (count($res_prof)== 0)) {
		$profil = $res_etu[0];
		$profil['mode']="etudiant";
		$profil['bConnect']=true;
		return true;
	}	
	if ((count($res_prof)> 0) && (count($res_etu)== 0)){
		$profil = $res_prof[0];
		$profil['mode']=$mode;		
		$profil['bConnect']=true;
		return true;
	}
	
	$profil = array();
	return false;
}

function liste_u_BD() {
	require ("modele/connect.php") ; 
}

?>
