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



	if(empty($_GET['id']))
	{
		header("Location: index.php");
	} else {
		$sql = "SELECT * FROM plat WHERE id = " . $_GET['id'];
		$query = $pdo->prepare($sql);
		$query->execute();
	
	}

	// On stocke le résultat dans un tableau associatif
	$infos = $query->fetch(PDO::FETCH_ASSOC);

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
		<title>Tricatel - Information</title>
	</head>

	<body>

		<?php include 'header.php' ?>

		<?php
			if (isset($_SESSION['message'])) { ?>
		<div id="message" class="alert alert-success" role="alert">
		  	<?= $_SESSION['message'] ?>
		</div>
		<?php 
				unset($_SESSION['message']);
			} 
		?>

		<div class="container">
			<div class="">
				<h1 id="title_text" class="text-center mt-3"><?= $infos['nom'] ?></h1>
				<img id="image_info" class="rounded my-3 mx-auto d-block" src="<?= $infos['lien_image'] ?>"/>
				<p id="classic_text"><?= $infos['description'] ?></p>
				<p id="classic_text">Origine du plat : <?= $infos['origine'] ?></p>
				<p id="classic_text">Type de repas : <?= $infos['type'] ?></p>
				<p id="classic_text">Goût : <?= $infos['type2'] ?></p>
				<p id="classic_text">Pratique alimentaire : <?= $infos['pratique_alimentaire'] ?></p>
			</div>
		</div>

		<?php include 'footer.php' ?>
		
		<script src="assets/javascript/script.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
	</body>


</html>