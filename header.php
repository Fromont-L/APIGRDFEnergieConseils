<!DOCTYPE html>
<html lang=fr>

	<body>
		<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-header">
			<a class="navbar-brand" href="index.php">
			<img src="assets/image/tricatel_logo.jpg" width="48" height="48" class="d-inline-block align-center" alt="" loading="lazy">
			TRICATEL
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
				</ul>
				<ul class="navbar-nav mx-3">
					<?php if($login) { ?>
					<li class="nav-item mx-3">
						<a class="nav-link btn" href="ajouter.php">Ajouter un plat</a>
					</li>
					<?php } ?>
					<li class="nav-item mx-3">
						<a class="nav-link btn" href="plats.php">Nos plats</a>
					</li>
				 	<?php if(!$login) { ?>
					<li class="nav-item mx-3">
						<a class="nav-link btn" href="tricatel.php">Connexion</a>
					 </li>
					<?php } ?>
					<?php if($login) { ?>
					<li class="nav-item mx-3">
						<a class="nav-link btn" href="deconnexion.php">Déconnexion</a>
					 </li>
					<?php } ?>

				</ul>
			</div>
		</nav>
	</body>
</html>