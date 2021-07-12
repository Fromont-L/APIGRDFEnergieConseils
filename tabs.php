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

	

?>

<!DOCTYPE html>
<html lang=fr>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="API GRDF"/>
		<meta name="author" content="Lucas Fromont, Aymeric Herchuelz"/>
		<link rel="icon" type="image/png" href="assets/image/API_GRDF_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>API GRDF - Accueil</title>
	</head>
	<body class="index_body">

		

		
		<?php include 'header.php'?>

		<div class="container my-3">
			<h1 class="big_title">Bienvenue sur GRDF, l'API en ligne</h1>
		</div>
		
		<div class="container">
			<nav class="tab navbar sticky-top navbar-expand-lg navbar-light bg-header">
			<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-header">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"aria-controls="navbarNav" aria-expended="false">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav mr-auto">
					</ul>
					<ul class="navbar-nav mx-3">
						<button class="tablink btn btn-sm" onclick="openPage('RecupererAccessToken', this, '#FFFFFF')" id="BoutonRecupererAccessToken">Récupérer Access Token</button>
						<button class="tablink btn btn-sm" onclick="openPage('DeclarerDroitAcces', this, '#FF9D08')" id="BoutonDeclarerDroitAcces">Declarer Droit Acces</button>
						
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDroitAcces', this, '#41CE21')" id="BoutonConsulterDroitAcces">Consulter Droit d'Accès</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDroitAccesSpecifiques', this, '#41CE21')" id="BoutonConsulterDroitAccesSpecifiques">Consulter Droit Accès Spécifiques</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDroitAccesSpecifique', this, '#41CE21')" id="BoutonConsulterDroitAccesSpecifique">Consulter Droit Access Spécifique</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterConsommationsPubliees', this, '#41CE21')" id="BoutonConsulterConsommationsPubliees">Consulter Consommation Publiées</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterConsommationsInformatives', this, '#41CE21')" id="BoutonConsulterConsommationsInformatives">Consulter Informations Informatives</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDonneesContractuelles', this, '#41CE21')" id="BoutonConsulterDonneesContractuelles">Consulter Données Contractuelles</button>
						<button class="tablink btn btn-sm" onclick="openPage('ConsulterDonneesTechniques', this, '#41CE21')" id="BoutonConsulterDonneesTechniques">Consulter Données Techniques</button>
					</ul>
				</div>
			</nav>

			<div id="RecupererAccessToken" class="tabcontent">
			  <h3>Récupérer un Access Token</h3>
			  <?php include 'access_token2.php' ?>
			</div>

			<div id="DeclarerDroitAcces" class="tabcontent">
			  <h3>DeclarerDroitAcces</h3>
			  <p>Déclarez votre droit d'accès</p>
			  <?php include 'declarer_droit_acces2.php'?>
			</div>

			<div id="ConsulterDroitAcces" class="tabcontent">
			  <h3>Consulter mes Droits d'Accès</h3>
			  <p>Retrouvez les droits d'accès que vous avez déclarés</p>
			  <?php include 'consulter_droit_acces2.php' ?>
			</div>

			<div id="ConsulterDroitAccesSpecifiques" class="tabcontent">
			  <h3>Consulter mesDroits d'Accès Spécifiques</h3>
			  <p>Retrouvez les droits d'accès que vous avez déclarés, mais cette fois-ci en selectionnant jusqu'à 3 PCE de votre choix</p>
			  <?php include 'consulter_droit_acces_specifiques2.php' ?>
			<div id="ConsulterDroitAccesSpecifique" class="tabcontent">
			  <h3>Contact</h3>
			  <p>Get in touch, or swing by for a cup of coffee.</p>
			</div>

			<div id="ConsulterConsommationsPubliees" class="tabcontent">
			  <h3>About</h3>
			
			</div>

			<div id="ConsulterConsommationsInformatives" class="tabcontent">
			  <h3>News</h3>
			  <p>Some news this fine day!</p>
			</div>

			<div id="ConsulterDonneesContractuelles" class="tabcontent">
			  <h3>News</h3>
			  <p>Some news this fine day!</p>
			</div>

			<div id="ConsulterDonneesTechniques" class="tabcontent">
			  <h3>News</h3>
			  <p>Some news this fine day!</p>
			</div>
			<div class="row py-5">
				
				<div class="col-lg-4 col-md-6 col-sm-12">
					<form action="declarer_droit_acces.php">
						<input type="submit" value="Déclarer un droit d'accès"/>
					</form>
					<form action="access_token.php">
						<input type="submit" value="Obtenir un access_token"/>
					</form>
				</div>
				
			</div>

			<?php include 'footer.php'?>
		</div>

		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

		<?php
			if(isset($_POST['token_button'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonRecupererAccessToken").click();</script>';
			}
			else if(isset($_POST['id_pce'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonDeclarerDroitAcces").click();</script>';		
			}
			else if(isset($_POST['bearerCDA'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDroitAcces").click();</script>';
			}
			else if(isset($_POST['bearerCDAS'])) {
				echo '<script type="text/javascript">document.getElementById("BoutonConsulterDroitAccesSpecifiques").click();</script>';
			}
			else {
				echo '<script type="text/javascript">document.getElementById("BoutonRecupererAccessToken").click();</script>';
			} 
		?>
	</body>
</html>