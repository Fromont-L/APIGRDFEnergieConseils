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

	function convertir_liste($arr){
		$resultatConvertion = "[";
		$isFirst = true;
		foreach($arr as $cb){
			if(!$isFirst) {
				$resultatConvertion .= ", ";
			}
			$resultatConvertion .= "\"" . $cb . "\"";
			$isFirst = false;
		}
		$resultatConvertion .= "]";
		return $resultatConvertion;
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

	if(isset($_POST['bearerCDAF']))
	{

		// Permet de faire une sélection parmi la liste de choix de role_tiers
		if (isset($_POST['role_tiersCDAF'])) {
			$role_tiers_list = convertir_liste($_POST['role_tiersCDAF']);
		}
		// Permet de faire une sélection parmi la liste de choix de etat_droit_acces
		if (isset($_POST['etat_droit_accesCDAF'])) {
			$etat_droit_acces_list = convertir_liste($_POST['etat_droit_accesCDAF']);
		}
		// Permet de faire une sélection parmi la liste de choix de statut_controle_preuve
		if (isset($_POST['statut_controle_preuveCDAF'])) {
			$statut_controle_preuve_list = convertir_liste($_POST['statut_controle_preuveCDAF']);
		}
		// Permet de faire une sélection parmi la liste de choix de statut_controle_preuve
		if (isset($_POST['id_pceCDAF'])) {
			$id_pce_list = convertir_liste($_POST['id_pceCDAF']);
		}
		// Exécute le code java consulterdroitacces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar consulterdroitaccesspecifique.jar"
		. " \"" . $role_tiers_list . "\""
		. " \"" . $etat_droit_acces_list . "\""
		. " \"" . $statut_controle_preuve_list . "\""
		. " \"" . $id_pce_list . "\""
		. " \"" . $_POST['bearerCDAF'] . "\"" 
		. " 2>&1";

		exec($cmd, $output);
		// Permet de savoir combien il y a de lignes dans la réponse (en enlever une parce que Java...)
		$tailleReponse = count($output) - 1;
		if($tailleReponse >= 2){
			// Retourne la valeur de la dernière ligne (retour traitement)
			$reponseCode = ((array)json_decode(utf8_encode($output[$tailleReponse - 1])));
			// $reponse = ((array)json_decode(utf8_encode($output[0])));
			// $reponseBrut = var_dump($output[2]);
			if(isset($reponseCode['code_statut_traitement']) && $reponseCode['code_statut_traitement'] == "0000000000"){
				$reponseEstPositive = true;
			} else {
				$reponseEstPositive = false;
			}
		}
		
	} else {
		$reponseEstPositive = false;
		$reponse = "lol";
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
	<body class="index_body">
		<?php include 'header.php'?>

		<div class="container my-3">
		<h1 class="text-center">Consulter un droit d'accès</h1>
		</div>

		<div class="container">
			<div class="row py-5">	
				<div class="col-12">
					<form method="POST" action="consulter_droit_acces_specifique.php">

						<!--Renseigner l'access_token-->
						<label>Insérer l'access_token : </label>
						<input type="text" id="bearerCDAF" name="bearerCDAF"/>
						<br/>

						<!--Renseigner le role_tiers-->
						<input type="checkbox" value="AUTORISE_CONTRAT_FOUNITURE" name="role_tiersCDAF[]">
						<label for="role_tiersCDAF[]">AUTORISE_CONTRAT_FOUNITURE</label>
						<input type="checkbox" value="DETENTEUR_CONTRAT_FOURNITURE" name="role_tiersCDAF[]">
						<label for="role_tiersCDAF[]">DETENTEUR_CONTRAT_FOURNITURE</label>

						<!--Renseigner l'etat_droit_acces-->
						<input type="checkbox" value="Active" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">Active</label>
						<input type="checkbox" value="A valider" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">A valider</label>
						<input type="checkbox" value="Révoquée" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">Révoquée</label>
						<input type="checkbox" value="A revérifier" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">A revérifier</label>
						<input type="checkbox" value="Obsolète" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">Obsolète</label>
						<input type="checkbox" value="Refusée" name="etat_droit_accesCDAF[]">
						<label for="etat_droit_accesCDAF[]">Refusée</label>

						<!--Renseigner le statut_controle_preuve-->
						<input type="checkbox" value="Preuve en attente" name="statut_controle_preuveCDAF[]">
						<label for="statut_controle_preuveCDAF[]">Preuve en attente</label>
						<input type="checkbox" value="Preuve en cours de vérification" name="statut_controle_preuveCDAF[]">
						<label for="statut_controle_preuveCDAF[]">Preuve en cours de vérification</label>
						<input type="checkbox" value="Preuve Vérifiée OK" name="statut_controle_preuveCDAF[]">
						<label for="statut_controle_preuveCDAF[]">Preuve Vérifiée OK</label>
						<input type="checkbox" value="Preuve Vérifiée KO" name="statut_controle_preuveCDAF[]">
						<label for="statut_controle_preuveCDAF[]">Preuve Vérifiée KO</label>

						<!--Renseigner le role_tiers-->
						<input type="checkbox" value="AUTORISE_CONTRAT_FOUNITURE" name="id_pceCDAF[]">
						<label for="id_pceCDAF[]">AUTORISE_CONTRAT_FOUNITURE</label>
						<input type="checkbox" value="DETENTEUR_CONTRAT_FOURNITURE" name="id_pceCDAF[]">
						<label for="id_pceCDAF[]">DETENTEUR_CONTRAT_FOURNITURE</label>
						<input type="checkbox" value="DETENTEUR_CONTRAT_FOURNITURE" name="id_pceCDAF[]">
						<label for="id_pceCDAF[]">DETENTEUR_CONTRAT_FOURNITURE</label>



						<input type="submit" value="Terminiert"/>
					</form> 
				</div>

				<div class="col-12">
				<?php
					if($reponseEstPositive){
						for ($i=0; $i < $tailleReponse - 1; $i++) {
							?>
							<div class="boxresult col-6">
							<?php 
							foreach (((array)json_decode(utf8_encode($output[$i]))) as $key => $value){
						    ?>
						    <p><?= $key . " : " . $value ?></p>
						    <?php
							}
							?>
							</div>
							<?php
						}
					}
				?>
				</div>
			</div>

			<div class="container">
				<div class="col-12">
					<p><?= $cmd ?></p>
				</div>
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