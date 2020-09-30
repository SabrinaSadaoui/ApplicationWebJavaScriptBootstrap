<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Bilan</title>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/> 
	<!--CSS-->
    <link rel="stylesheet" href="./vue/Etudiant/styleCSS/menuEtudiant.css">
    <link rel="stylesheet" href="./vue/Professeur/styleCSS/ResEtudiant.css">
	<!--JavaScript-->
	<script src="./vue/Etudiant/Js/menuEtudiant.js"></script>
	<!--Font awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <nav> 	
		<?php  require("./vue/Etudiant/menuEtudiant.tpl"); ?>
	</nav> 
	<!-- fin du menu nav -->
	<section class="our-webcoderskull padding-lg">
        <div class="container">
            <div class="row heading heading-icon">
                <h2>Resultat étudiant</h2>
            </div>
            <ul class="row">
                <li class="col col-md col-lg">
            <?php
                if($bilan != false){
                    foreach($bilan as $th){                  	
                        setlocale(LC_TIME, "fr_FR", "French");									
                        echo '                                  
                            <div class="cnt-block equal-hight" style="height: 349px;">
                                <figure><img src="https://static.vecteezy.com/system/resources/previews/000/511/962/non_2x/vector-student-glyph-black-icon.jpg" alt="..." width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm" class="img-responsive" alt=""></figure>
                                <h3><a href="#">'.utf8_encode ($th['nom'])." ".utf8_encode ($th['prenom']).'</a></h3>
                                <p>Titre test : '.utf8_encode ($th['titre_test']).'</p>
                                <p>Thème : '.utf8_encode ($th['titre_theme']).'</p>
                                <p>Note : '.utf8_encode ($th['note_test']).' / 20</p>
                                
                            </div>          
                        ';
                    }			
                }else{
                    echo '
                        <h1> Pas de résultat etudiant</h1>
                    ';
                }				
            ?>
            </li>
		 </ul>
  </div>
</section>
</body>
</html>
