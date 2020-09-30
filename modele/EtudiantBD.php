<?php

function get_test_BD($grpe_etu){
    require ("./modele/connect.php"); 
    $sql_test = " SELECT *
                FROM test t 
                INNER JOIN qcm q
                ON t.id_test = q.id_test
                INNER JOIN question quest
                ON q.id_quest = quest.id_quest
                WHERE t.num_grpe= :grp AND t.bActif = 1  
                GROUP BY t.titre_test"
                ;
    try{
        $cde_test = $pdo->prepare($sql_test);
        $cde_test->bindParam(':grp', $grpe_etu);
        $b_test= $cde_test->execute();
        $tabIdTest = array();
        if($b_test){
            while($tab = $cde_test->fetch()){
                $tabIdTest[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdTest;
}
    
function getQuestionBD($idTest){
    require ("./modele/connect.php"); 
    $sql_Question = " SELECT * 
    FROM test t 
    INNER JOIN qcm q 
    ON t.id_test = q.id_test 
    INNER JOIN question quest 
    ON q.id_quest = quest.id_quest 
    INNER JOIN theme the 
    ON quest.id_theme = the.id_theme 
    WHERE t.id_test= :idtheme AND q.bAutorise = 1
                ";
    try{
        $cde_Question  = $pdo->prepare($sql_Question );
        $cde_Question->bindParam(':idtheme', $idTest);
        $b_Question = $cde_Question ->execute();
        $tabIdQuestion = array();
        if($b_Question ){
            while($tab = $cde_Question->fetch()){
                $tabIdQuestion [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdQuestion ;
}

function getQuestionQuestBD($idquestion){
    require ("./modele/connect.php"); 
    $sql_Question = " SELECT * 
    FROM test t 
    INNER JOIN qcm q 
    ON t.id_test = q.id_test 
    INNER JOIN question quest 
    ON q.id_quest = quest.id_quest 
    INNER JOIN theme the 
    ON quest.id_theme = the.id_theme 
    WHERE quest.id_quest= :idquest
    GROUP By quest.texte
                ";
    try{
        $cde_Question  = $pdo->prepare($sql_Question );
        $cde_Question->bindParam(':idquest', $idquestion);
        $b_Question = $cde_Question ->execute();
        $tabIdQuestion = array();
        if($b_Question ){
            while($tab = $cde_Question->fetch()){
                $tabIdQuestion [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdQuestion ;
}

function getReponseBD($idquest){
    require ("./modele/connect.php"); 
    $sql_Reponse= " SELECT * 
    FROM question quest 
    INNER JOIN reponse r 
    ON quest.id_quest = r.id_quest 
    WHERE quest.id_quest = :idquest
    ";
    try{
        $cde_Reponse  = $pdo->prepare($sql_Reponse );
        $cde_Reponse->bindParam(':idquest', $idquest);
        $b_Reponse = $cde_Reponse ->execute();
        $tabIdReponse = array();
        if($b_Reponse ){
            while($tab = $cde_Reponse->fetch()){
                $tabIdReponse [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdReponse;
}

function getBonneReponseBD($idquestion){
    require ("./modele/connect.php"); 
    $sql_BonneReponse= " SELECT * 
                    FROM reponse r 
                    INNER JOIN question q
                    ON r.id_quest = q.id_quest
                    WHERE q.id_quest=:idquestion AND r.bvalide=1
    ";
    try{
        $cde_BonneReponse  = $pdo->prepare($sql_BonneReponse );
        $cde_BonneReponse->bindParam(':idtheme', $idTest);
        $b_BonneReponse = $cde_BonneReponse ->execute();
        $tabIdBonneReponse = array();
        if($b_BonneReponse ){
            while($tab = $cde_BonneReponse->fetch()){
                $tabIdBonneReponse [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdBonneReponse;
}

function getProfil_BD($id){
    require ("./modele/connect.php"); 
    $sql_etu = " SELECT * 
                FROM etudiant e
                WHERE e.id_etu = :v
                ";
    try{
        $cde_etu  = $pdo->prepare($sql_etu );
        $cde_etu->bindParam(':v', $id);
        $b_etu  = $cde_etu ->execute();
        $tabIdetu = array();
        if($b_etu ){
            while($tab = $cde_etu->fetch()){
                $tabIdetu [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdetu ;
}

function setProfil_BD($n,$p,$em,$le,$pe,$ide){
    require ("./modele/connect.php"); 
    $sql_set = " UPDATE etudiant e
                SET `nom`=:n,
                `prenom`=:p,
                `email`= :em,
                `login_etu`=:le,
                `pass_etu`= :pe
                WHERE e.id_etu = :ide
                ";
    try{
        $cde_set = $pdo->prepare($sql_set);
        $cde_set->bindParam(':n', $n);
        $cde_set->bindParam(':p', $p);
        $cde_set->bindParam(':em', $em);
        $cde_set->bindParam(':le', $le);
        $cde_set->bindParam(':pe', $pe);
        $cde_set->bindParam(':ide', $ide);
        $b_set = $cde_set->execute();
        $tabset = array();
        if($b_set){
            $index = 0;
            while($tab = $cde_set->fetch()){
                $tabset[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de update : " . $e->getMessage() . "\n");
		die();
    }
    return $tabset;
}

function get_services_BD(){
	require ("./modele/connect.php"); 
	 $sql_an = " SELECT p.nom, p.prenom, p.email FROM professeur p;
                ";
     try{           
	 $cde_an = $pdo->prepare($sql_an);
        $b_an = $cde_an->execute();
        $tabAn = array();
        if($b_an){
            while($tab = $cde_an->fetch()){
                $tabAn[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabAn;
	
}

function getBilanBD($idetu){
    require ("./modele/connect.php"); 
    $sql_Bilan= " SELECT * 
                FROM bilan b
                INNER JOIN etudiant e
                ON b.id_etu = e.id_etu
                INNER JOIN test t
                ON b.id_test = t.id_test
                INNER JOIN qcm q 
                ON t.id_test = q.id_test 
                INNER JOIN question quest 
                ON q.id_quest = quest.id_quest 
                INNER JOIN theme the 
                ON quest.id_theme = the.id_theme
                WHERE e.id_etu = :idetu
                ";
    try{
        $cde_Bilan  = $pdo->prepare($sql_Bilan  );
        $cde_Bilan->bindParam(':idetu', $idetu);
        $b_Bilan = $cde_Bilan ->execute();
        $tabIdBilan = array();
        if($b_Bilan ){
            while($tab = $cde_Bilan->fetch()){
                $tabIdBilan [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdBilan;
}

function setBilanBD($idetu,$idtest,$nbrQ){
    require ("./modele/connect.php"); 
    $sql_Bilan= " INSERT INTO `bilan`(`id_bilan`, `id_test`, `id_etu`, `note_test`, `date_bilan`) 
                VALUES (:id_blian,:id_test,:id_etu,:note_test,'2019-10-20')
                ";
try{
        $cde_addB = $pdo->prepare($sql_add);
        $cde_addB->bindParam(':id_test', $idtest);
        $cde_addB->bindParam(':id_etu', $idetu);
        $cde_addB->bindParam(':note_test', $idetu);
        $b_addB = $cde_addB->execute();
        $tabaddBilan = array();
        if($b_addB){
            $index = 0;
            while($tab = $cde_addB->fetch()){
                $tabaddBilan[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec d'insertion : " . $e->getMessage() . "\n");
		die();
    }
    return $tabaddBilan;
}


function getNbrQuestionBD($idtest,$idetu){
    require ("./modele/connect.php"); 
    $sql_nbr = " SELECT COUNT(id_res) 
                FROM resultat r
                WHERE r.id_test = :id_test AND r.id_etu = :id_etu;
                ";
    try{
        $cde_nbr  = $pdo->prepare($sql_nbr );
        $cde_nbr->bindParam(':id_test', $idtest);
        $cde_nbr->bindParam(':id_etu', $idetu);
        $b_nbr  = $cde_nbr ->execute();
        $tabIdetu = array();
        if($b_etu ){
            while($tab = $cde_etu->fetch()){
                $tabIdetu [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdetu ;
}


?>