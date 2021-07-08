<?php
	
	/*
	function get_token()
	{
		// Exécute le code java tokentest.jar
		exec("\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar tokentest.jar 2>&1", $output);
		// Retourne la valeur de access_token
		return ((array)json_decode(utf8_encode($output[0])))['access_token'];
	}
	*/

	if(isset($_POST['bearerCDA']))
	{

	  // Exécute le code java consulterdroitacces.jar
		$cmd = "\"jdk-8.0.292.10-hotspot\\jre\\bin\\java.exe\" -jar consulterdroitacces.jar"
		. " \"" . $_POST['bearerCDA'] . "\"" 
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

		<div class="container my-3">
		<h1 class="text-center">Consulter un droit d'accès</h1>
		</div>

		<div class="container">
			<div class="row py-5">	
				<div class="col-12">
					<form method="POST" action="consulter_droit_acces2.php">

						<!--Renseigner l'access_token-->
						<label>Insérer l'access_token : </label>
						<input type="text" id="bearerCDA" name="bearerCDA"/>
						<br/>

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