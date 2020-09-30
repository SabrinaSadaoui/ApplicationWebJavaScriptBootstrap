<?php 

function read_contacts_BD($idu) {

		require ("modele/connect.php") ; 
		//global $pdo;
		
	$sql="select nom, prenom, email 
				from contact c, utilisateur u 
				where c.id_nom = :idu
				and c.id_contact = u.id_nom
				limit 0,30";
	$resultat= array(); 
	
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':idu', $idu);
		$bool = $commande->execute();
		if ($bool) {
			$resultat = $commande->fetchAll(PDO::FETCH_ASSOC); //tableau d'enregistrements
			}
		}
	catch (PDOException $e) {
		$msg = utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die($msg); // On arrête tout.
	}
	
	return $resultat;

}
?>
