<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->sessionLogin();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	/*
	function get_token()
	{
		// Exécute le code java tokentest.jar
		exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar tokentest.jar 2>&1", $output);
		// Retourne la valeur de access_token
		return ((array)json_decode(utf8_encode($output[0])))['access_token'];
	}
	*/

	if(isset($_POST['id_pce']))
	{

	  // Exécute le code java declarer_droit_acces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar declarerdroitacces.jar \"" 
	   . $_POST['raison_sociale'] . "\" \""  
	   . $_POST['code_postal'] . "\" \"" 
	   . $_POST['courriel_titulaire'] . "\" \"" 
	   . $_POST['date_consentement_declaree'] . "\" \"" 
	   . $_POST['date_fin_autorisation_demandee'] . "\" \"" 
	   . $_POST['perim_donnees_techniques_et_contractuelles'] . "\" \"" 
	   . $_POST['perim_historique_de_donnees'] . "\" \"" 
	   . $_POST['perim_flux_de_donnees'] . "\" \"" 
	   . $_POST['perim_donnees_informatives'] . "\" \"" 
	   . $_POST['perim_donnees_publiees']  . "\" \""
	   . $_POST['id_pce'] . "\" \""
	   . $_POST['bearerDDA'] . "\""
	   . " 2>&1";

		exec($cmd, $output);
		// Retourne la valeur de access_token
		// $erreur = ((array)json_decode($output[0]))['message_retour_traitement'];
		 $erreur = var_dump($output[0]);
		// celui du dessus ne fonctionne pas ? faire ->
		// $erreur = var_dump($output[0]);
	} else {
		$erreur = "lol";
		$cmd = "lol2";
	}

?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="Tricatel, plats industriels"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="assets/image/tricatel_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Déclarer un droit d'accès</title>
	</head>
	<body>

		<?php include 'header.php'?>

		<div class="container my-3">
			<h1 class="text-center">Déclarer un droit d'accès</h1>
		</div>
		
		<div class="container">
			<div class="row py-5">

				
				
				<div class="col-6">
					<form method="POST" action="declarer_droit_acces.php">

						<!--Renseigner l'access_token-->
						<label>Insérer l'access_token : </label>
						<input type="text" id="bearerDDA" name="bearerDDA"/>
						<br/>

						<!--Insérer l'ID PCE du client-->
						<label>ID PCE : </label><br/>
						<input type="text" id="id_pce" name="id_pce"/>
						<br/>

						<!--Insérer le nom de l'entreprise-->
						<label>Raison Sociale : </label>
						<input type="text" id="raison_sociale" name="raison_sociale"/>
						<br/>

						<!--Insérer le Code Postal-->
						<label>Code Postal : </label>
						<input type="text" id="code_postal" name="code_postal"/>
						<br/>

						<!--Insérer l'adresse mail de l'entreprise-->
						<label>Adresse mail du Titulaire : </label>
						<input type="text" id="courriel_titulaire" name="courriel_titulaire"/>
						<br/>

						<!--Choisir la date du consentement déclarée-->
						<label>Date de Consentement Déclarée : </label>
						<input type="text" id="date_consentement_declaree" name="date_consentement_declaree"/>
						<br/>

						<!--Choisir la date de fin de l'autorisation demandée-->
						<label>Date de Fin de l'Autorisation Demandée : </label>
						<input type="text" id="date_fin_autorisation_demandee" name="date_fin_autorisation_demandee"/>
						<br/>

						<!--Choisir d'afficher les données techniques et contractuelles (vrai par défaut)-->
						<label>Afficher les Données Techniques et Contractuelles : </label>
						<br/>
						<input type="radio" id="perim_donnees_techniques_et_contractuelles" name="perim_donnees_techniques_et_contractuelles" value="vrai" checked/>
						<label for="vrai">Vrai</label>
						<input type="radio" id="perim_donnees_techniques_et_contractuelles" name="perim_donnees_techniques_et_contractuelles" value="faux"/>
						<label for="faux">Faux</label>
						<br/>

						<!--Choisir d'afficher l'historique de données (vrai par défaut)-->
						<label>Afficher l'Historique de Données : </label>
						<br/>
						<input type="radio" id="perim_historique_de_donnees" name="perim_historique_de_donnees" value="vrai" checked/>
						<label for="vrai">Vrai</label>
						<input type="radio" id="perim_historique_de_donnees" name="perim_historique_de_donnees" value="faux"/>
						<label for="faux">Faux</label>
						<br/>

						<!--Choisir d'afficher le flux de données (vrai par défaut)-->
						<label>Afficher le Flux de Données : </label>
						<br/>
						<input type="radio" id="perim_flux_de_donnees" name="perim_flux_de_donnees" value="vrai" checked/>
						<label for="vrai">Vrai</label>
						<input type="radio" id="perim_flux_de_donnees" name="perim_flux_de_donnees" value="faux"/>
						<label for="faux">Faux</label>
						<br/>

						<!--Choisir d'afficher les données informatives (vrai par défaut)-->
						<label>Afficher les Données Informatives : </label>
						<br/>
						<input type="radio" id="perim_donnees_informatives" name="perim_donnees_informatives" value="vrai" checked/>
						<label for="vrai">Vrai</label>
						<input type="radio" id="perim_donnees_informatives" name="perim_donnees_informatives" value="faux"/>
						<label for="faux">Faux</label>
						<br/>
						
						<!--Choisir d'afficher les données publiées (vrai par défaut)-->
						<label>Afficher les Données Publiées : </label>
						<br/>
						<input type="radio" id="perim_donnees_publiees" name="perim_donnees_publiees" value="vrai" checked/>
						<label for="vrai">Vrai</label>
						<input type="radio" id="perim_donnees_publiees" name="perim_donnees_publiees" value="faux"/>
						<label for="faux">Faux</label>
						<br/>

						<input type="submit" value="Terminiert"/>
					</form> 
				</div>
				
				<div class="col-6">
					<p><?= $erreur ?></p>
				</div>


				
			</div>
			<div class="container">
				<div class="col-12">
					<p><?= $cmd ?></p>
				</div>
			</div>

			<br/>
			<br/>
			<br/>
			<br/>

		<?php include 'footer.php'?>
		

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>


	</body>
</html>