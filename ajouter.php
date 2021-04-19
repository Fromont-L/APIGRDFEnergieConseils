<?php

	session_start();
	require './db_inc.php';
	require './account_class.php';

	require 'dropdown.php';

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

	if (!$login) {
		header("Location: index.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

		$nom = $_POST['nom'];
		$description = $_POST['description'];
		$origine = $_POST['origine'];
		$type = $_POST['type'];
		$type2 = $_POST['type2'];
		$pratique_alimentaire = $_POST['pratique_alimentaire'];
		$lien_image = $_POST['lien_image'];

		$sql = "SELECT count(*) FROM plat WHERE nom = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($nom));
		$plat = $q->fetch(PDO::FETCH_ASSOC);

		if($plat == 0){
			
			$sql = "INSERT INTO plat (nom, description, origine, type, type2, pratique_alimentaire, lien_image) values(?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($nom, $description, $origine, $type, $type2, $pratique_alimentaire, $lien_image));

			$_SESSION['message'] = "Ajout effectué !";
			header("Location: plats.php");
		}
	}

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content="Tricatel, plats industriels"/>
		<meta name="author" content="Lucas Fromont"/>
		<link rel="icon" type="image/png" href="assets/image/tricatel_logo.jpg"/>
		<link rel="stylesheet" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<title>Tricatel - Ajouter</title>
	</head>

	<body>

		<?php include 'header.php' ?>

		

		<div class="container">
			<h1>Ajouter un plat</h1>	
			<form method="post" action="ajouter.php" class="center">
				<!--Remplir le nom du plat-->
				<div class="form-group">
					<label for="plat">Entrez le nom du plat</label>
					<input type="text" class="form-control" value="<?php echo !empty($nom)?$nom:''; ?>" placeholder="Lasagnes de légumes" name="nom" required/>
				</div>
				<?php
					if (isset($plat)) {
						if ($plat != 0) { ?>
				<div id="message" class="alert alert-danger" role="alert">
				  	Ce nom est déjà utilisé, veuillez en choisir un autre
				</div>
				<?php 
						} 
					}
				?>
				<!--Remplir la description du plat-->
				<div class="form-group">
					<label for="description">Entrez une description du plat</label>
					<input type="text" class="form-control" value="<?php echo !empty($description)?$description:''; ?>" placeholder="C'est vraiment le meilleur plat du monde, je pourrai en manger tous les jours sans me lasser..." name="description" required/>
				</div>
				<!--Remplir l'origine du plat-->
				<div class="form-group">
					<label for="origine">Entrez l'origine du plat : </label>
					
					<?= enumDropdown("plat", "origine") ?>
					
				</div>
				<div class="form-group">
					<label for="type">Sélectionnez les caractéristiques du plat : </label>
					<?= enumDropdown("plat", "type") ?>
				</div>
				<div class="form-group">
					<label for="selsucre">Sélectionnez le goût : </label>
					<?= enumDropdown("plat", "type2") ?>
				</div>
				<div class="form-group">
					<label for="pratique_alimentaire">Sélectionnez la pratique alimentaire : </label>
					<?= enumDropdown("plat", "pratique_alimentaire") ?>
				</div>
				<div class="form-group">
					<label for="lien_image">Entrez l'URL d'une image valide</label>
					<input type="url" name="lien_image" id="lien_image" class="form-control" value="<?php echo !empty($lien_image)?$lien_image:''; ?>" placeholder="https://example.com" required/>
				</div>
					<button class="btn btn-success btn-lg btn-block my-3" type="submit">Ajouter le nouveau plat !</button>
			</form>
		</div>

		<?php include 'footer.php' ?>
		
		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>


</html>