<?php

function get_themeQcm_BD(){
    require ("./modele/connect.php"); 
    $sql_qcm = " SELECT q.id_theme, q.titre_theme, q.desc_theme FROM theme q";
    try{
        $cde_qcm = $pdo->prepare($sql_qcm);
        $b_qcm = $cde_qcm->execute();
        $tabIdQcm = array();
        if($b_qcm){
            while($tab = $cde_qcm->fetch()){
                $tabIdQcm[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdQcm;
}


function testProff($id_prof){
    require ("./modele/connect.php"); 
    $sql_test = " SELECT * 
                        FROM professeur p
                        INNER JOIN test t
                        ON p.id_prof = t.id_prof
                        WHERE t.id_prof = :idp
                        ";
    try{
        $cde_test = $pdo->prepare($sql_test);
        $cde_test->bindParam(':idp', $id_prof);
        $b_test = $cde_test->execute();
        $tabtest = array();
        if($b_test){
            $index = 0;
            while($tab = $cde_test->fetch()){
                $tabtest[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabtest;
}

function testProf_BD($id_prof){
    require ("./modele/connect.php"); 
    $sql_test = " SELECT * 
                FROM test t 
                INNER JOIN qcm q 
                ON t.id_test = q.id_test 
                INNER JOIN question quest 
                ON q.id_quest = quest.id_quest 
                INNER JOIN theme the 
                ON quest.id_theme = the.id_theme 
                WHERE t.id_prof = :idp
                GROUP BY the.titre_theme
                        ";
    try{
        $cde_test = $pdo->prepare($sql_test);
        $cde_test->bindParam(':idp', $id_prof);
        $b_test = $cde_test->execute();
        $tabtest = array();
        if($b_test){
            $index = 0;
            while($tab = $cde_test->fetch()){
                $tabtest[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabtest;
}

function testQuestion_BD($id_theme){
    require ("./modele/connect.php"); 
    $sql_test = " SELECT * 
                FROM test t 
                INNER JOIN qcm q 
                ON t.id_test = q.id_test 
                INNER JOIN question quest 
                ON q.id_quest = quest.id_quest 
                INNER JOIN theme the 
                ON quest.id_theme = the.id_theme 
                WHERE the.id_theme = :idtheme
                        ";
    try{
        $cde_test = $pdo->prepare($sql_test);
        $cde_test->bindParam(':idtheme', $id_theme);
        $b_test = $cde_test->execute();
        $tabtest = array();
        if($b_test){
            $index = 0;
            while($tab = $cde_test->fetch()){
                $tabtest[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabtest;
}

function setA_B_V_Question_BD($v,$b,$a,$idqcm){
    require ("./modele/connect.php"); 
    $sql_set = " UPDATE qcm q 
                SET `bAutorise`= :v ,`bBloque`= :b ,`bAnnule`= :a 
                WHERE q.id_qcm = :idqcm
                ";
    try{
        $cde_set = $pdo->prepare($sql_set);
        $cde_set->bindParam(':v', $v);
        $cde_set->bindParam(':b', $b);
        $cde_set->bindParam(':a', $a);
        $cde_set->bindParam(':idqcm', $idqcm);
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
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabset;
}

function getResEtudiant_BD(){
    require ("./modele/connect.php"); 
    $sql_ResEtudiant = " SELECT * 
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
                        GROUP BY e.nom
                        ";
    try{
        $cde_ResEtudiant = $pdo->prepare($sql_ResEtudiant);
        $b_ResEtudiant = $cde_ResEtudiant->execute();
        $tabResEtudiant= array();
        if($b_ResEtudiant){
            while($tab = $cde_ResEtudiant->fetch()){
                $tabResEtudiant[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabResEtudiant;
}
    
function setEtatTest_BD($v,$idtest){
    require ("./modele/connect.php"); 
    $sql_set = " UPDATE test t 
                SET t.bActif = :v
                WHERE t.id_test = :id_test
                ";
    try{
        $cde_set = $pdo->prepare($sql_set);
        $cde_set->bindParam(':v', $v);
        $cde_set->bindParam(':id_test', $idtest);
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
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabset;
}

function getProfil_BD($id){
    require ("./modele/connect.php"); 
    $sql_prof = " SELECT * 
                FROM professeur p
                WHERE p.id_prof = :v
                ";
    try{
        $cde_prof  = $pdo->prepare($sql_prof );
        $cde_prof->bindParam(':v', $id);
        $b_prof  = $cde_prof ->execute();
        $tabIdprof = array();
        if($b_prof ){
            while($tab = $cde_prof->fetch()){
                $tabIdprof [] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabIdprof ;
}

function setProfil_BD($n,$p,$em,$lp,$pf,$id){
    require ("./modele/connect.php"); 
    $sql_set = " UPDATE professeur p
                SET `nom`=:n,
                `prenom`=:p,
                `email`= :em,
                `login_prof`=:lp,
                `pass_prof`= :pf
                WHERE p.id_prof = :idp
                ";
    try{
        $cde_set = $pdo->prepare($sql_set);
        $cde_set->bindParam(':n', $n);
        $cde_set->bindParam(':p', $p);
        $cde_set->bindParam(':em', $em);
        $cde_set->bindParam(':lp', $lp);
        $cde_set->bindParam(':pf', $pf);
        $cde_set->bindParam(':idp', $id);
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

function CreateQuestion_BD($idQuest,$idtheme,$titre,$quest){
    require ("./modele/connect.php"); 
    $sql_add = " INSERT INTO `question`(`id_quest`, `id_theme`, `titre`, `texte`, `bmultiple`) 
                VALUES (:q,:th,:ttr,:quest,0)
                ";
    try{
        $cde_add = $pdo->prepare($sql_add);
        $cde_add->bindParam(':q', $idQuest);
        $cde_add->bindParam(':th', $idtheme);
        $cde_add->bindParam(':ttr', $titre);
        $cde_add->bindParam(':quest', $quest);
        $b_add = $cde_add->execute();
        $tabadd = array();
        if($b_add){
            $index = 0;
            while($tab = $cde_add->fetch()){
                $tabadd[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabadd;
}

function CreateQCM_BD($idqcm,$idTest,$idQuest){
    require ("./modele/connect.php"); 
    $sql_add = " INSERT INTO `qcm`(`id_qcm`, `id_test`, `id_quest`, `bAutorise`, `bBloque`, `bAnnule`)
                 VALUES (:idqcm,:idtest,:q,1,0,0)
                ";
    try{
        $cde_add = $pdo->prepare($sql_add);
        $cde_add->bindParam(':idqcm', $idqcm);
        $cde_add->bindParam(':idtest', $idTest);
        $cde_add->bindParam(':q', $idQuest);
        $b_add = $cde_add->execute();
        $tabadd = array();
        if($b_add){
            $index = 0;
            while($tab = $cde_add->fetch()){
                $tabadd[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabadd;
}

function CreateReponse_BD($idrep,$idQuest,$reponse){
    require ("./modele/connect.php"); 
    $sql_add = " INSERT INTO `reponse`(`id_rep`, `id_quest`, `texte_rep`, `bvalide`) 
                VALUES (:idrep, :idquestion, :rep,1)
                ";
    try{
        $cde_add = $pdo->prepare($sql_add);
        $cde_add->bindParam(':idrep', $idrep);
        $cde_add->bindParam(':idquestion', $idQuest);
        $cde_add->bindParam(':rep', $reponse);
        $b_add = $cde_add->execute();
        $tabadd = array();
        if($b_add){
            $index = 0;
            while($tab = $cde_add->fetch()){
                $tabadd[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabadd;
}

function CreateReponseFausse_BD($idrep,$idQuest,$reponse){
    require ("./modele/connect.php"); 
    $sql_add = " INSERT INTO `reponse`(`id_rep`, `id_quest`, `texte_rep`, `bvalide`) 
                VALUES (:idrep, :idquestion, :rep,0)
                ";
    try{
        $cde_add = $pdo->prepare($sql_add);
        $cde_add->bindParam(':idrep', $idrep);
        $cde_add->bindParam(':idquestion', $idQuest);
        $cde_add->bindParam(':rep', $reponse);
        $b_add = $cde_add->execute();
        $tabadd = array();
        if($b_add){
            $index = 0;
            while($tab = $cde_add->fetch()){
                $tabadd[$index] = $tab;
                $index += 1 ;    
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabadd;
}

function getAllReponse(){
    require ("./modele/connect.php"); 
    $sql_Reponse = " SELECT * 
                        FROM reponse
                        ";
    try{
        $cde_Reponse = $pdo->prepare($sql_Reponse);
        $b_Reponse = $cde_Reponse->execute();
        $tabReponse= array();
        if($b_Reponse){
            while($tab = $cde_Reponse->fetch()){
                $tabReponse[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabReponse;
}

function getAllQuestion(){
    require ("./modele/connect.php"); 
    $sql_Question = " SELECT * 
                        FROM question quest 
                        ";
    try{
        $cde_Question = $pdo->prepare($sql_Question);
        $b_Question = $cde_Question->execute();
        $tabQuestion= array();
        if($b_Question){
            while($tab = $cde_Question->fetch()){
                $tabQuestion[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabQuestion;
}

function getAllQcm(){
    require ("./modele/connect.php"); 
    $sql_qcm = " SELECT * 
                        FROM qcm
                        ";
    try{
        $cde_qcm = $pdo->prepare($sql_qcm);
        $b_qcm = $cde_qcm->execute();
        $tabqcm = array();
        if($b_qcm){
            while($tab = $cde_qcm->fetch()){
                $tabqcm[] = $tab;
            }
        }
    }
    catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die();
    }
    return $tabqcm;
}


?>