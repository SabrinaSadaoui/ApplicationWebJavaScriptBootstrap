<?php
$nom = $_SESSION['profil']['nom'];
$prenom = $_SESSION['profil']['prenom'];

function accueil()
{
	global $nom, $prenom;
	require("./vue/Professeur/accueilProfesseur.tpl");
}

function bye()
{
	session_destroy();
	$nexturl = "index.php?controle=utilisateur&action=ident";
	header("Location:" . $nexturl);
}

function getTestProf(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	$idprof = $_SESSION['profil']['id_prof'];
	$test = testProf_BD($idprof);
	$test2 = testProf_BD($idprof);
	require("./vue/professeur/TestProf.tpl");
}

function getquestion(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	if(isset($_POST['id'])){
		$idtheme = $_POST['id'];
	}else{
		$idtheme="";
	}      
	$question = testQuestion_BD($idtheme);
	require("./vue/professeur/Question.tpl");
}

function setA_B_V_Question(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	if(isset($_POST['idq']) && isset($_POST['mode'])){
		$idtheme = $_POST['idq'];
		$mode = $_POST['mode'];
		if($mode=="valider"){
			setA_B_V_Question_BD(1,0,0,$idtheme);
		}else if($mode=="bloquer"){
			setA_B_V_Question_BD(0,1,0,$idtheme);
		}else if($mode=="annuler"){
			setA_B_V_Question_BD(0,0,1,$idtheme);
		}
	}else{
		echo'Erreur';
	}   
	$nexturl = "index.php?controle=Professeur&action=getTestProf";
	header("Location:" . $nexturl);   	
}

function getResEtudiant(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	$ResEtudiant = getResEtudiant_BD();
	require("./vue/professeur/ResEtudiant.tpl");
}

function setEtatTest(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	if(isset($_POST['idq']) && isset($_POST['mode'])){
		$idtest = $_POST['idq'];
		$btnm = $_POST['mode'];
		if($btnm == "Lancer le test"){		
			setEtatTest_BD(1,$idtest);
		}else if($btnm == "Arrêter le test"){
			setEtatTest_BD(0,$idtest);
		}

	}else{
		echo'erreur';
	}
	$nexturl = "index.php?controle=Professeur&action=getTestProf";
	header("Location:" . $nexturl);
}

function getProfil(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	$idprof = $_SESSION['profil']['id_prof'];
	$profil = getProfil_BD($idprof);
	require("./vue/professeur/Profil.tpl");
}

function setprofilprof(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	$idprof = $_SESSION['profil']['id_prof'];
	$profil = getProfil_BD($idprof);
	require("./vue/professeur/SetProfil.tpl");
}

function setProfil(){
	require('./modele/ProfesseurBD.php');
	$idprofesseur = $_POST['idq'];
	$n = isset($_POST['n'])?($_POST['n']):'';
	$p = isset($_POST['p'])?($_POST['p']):'';
	$em = isset($_POST['em'])?($_POST['em']):'';
	$lp = isset($_POST['lp'])?($_POST['lp']):'';
	$pass = isset($_POST['pass'])?($_POST['pass']):'';
	if(!(empty($idprofesseur) && Empty($n) && Empty($p) && Empty($em) && Empty($lp) && Empty($pass))){
		setProfil_BD($n,$p,$em,$lp,$pass,$idprofesseur);
	}else{
		echo 'Vide ou pas valide';
	}
	$nexturl = "index.php?controle=Professeur&action=getProfil";
	header("Location:" . $nexturl);  
}

function createQuestion(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	if(isset($_POST['idd']) && isset($_POST['iddq']) && isset($_POST['iddtest'])){
		$idtheme = $_POST['idd'];
		$idqcm = ($_POST['iddq']);
		$idTest = ($_POST['iddtest']);
	}else{
		echo'erreur';
	}
	require("./vue/professeur/CreateQuestion.tpl");
}

function createQuestionProf(){
	global $nom, $prenom;
	require('./modele/ProfesseurBD.php');
	/**
	 * Création de question
	 */
	$allquestion =  getAllQuestion();
	$idquestion = count($allquestion)+1;
	$idtheme = isset($_POST['idtheme'])?($_POST['idtheme']):'';
	$titre = isset($_POST['titre'])?($_POST['titre']):'';
	$question = isset($_POST['question'])?($_POST['question']):'';
	CreateQuestion_BD($idquestion,$idtheme,$titre,$question);
	/**
	 * Création qcm
	 */
	$idTest = isset($_POST['idtest'])?($_POST['idtest']):'';
	$allqcm = count(getAllQcm())+1;
	$idQCM = $allqcm;
	CreateQCM_BD($idQCM,$idTest,$idquestion);
	/**
	 * Création réponse
	 */
	$reponse = isset($_POST['reponse'])?($_POST['reponse']):'';
	$allreponse = count(getAllReponse())+1;
	$idreponse = $allreponse;
	$reponse = isset($_POST['reponse'])?($_POST['reponse']):'';
	CreateReponse_BD($idreponse,$idquestion,$reponse);
	/**
	 * Création réponse fausse
	 */
	$reponseFause1 = isset($_POST['reponsef1'])?($_POST['reponsef1']):'';
	$reponseFause2 = isset($_POST['reponsef2'])?($_POST['reponsef2']):'';
	$idreponseFausse1 = $idreponse+1;
	$idreponseFausse2 = $idreponse+2;
	CreateReponseFausse_BD($idreponseFausse1,$idquestion,$reponseFause1);
	CreateReponseFausse_BD($idreponseFausse2,$idquestion,$reponseFause2);

	$idprof = $_SESSION['profil']['id_prof'];
	$test = testProf_BD($idprof);
	require("./vue/professeur/TestProf.tpl");
}


?>