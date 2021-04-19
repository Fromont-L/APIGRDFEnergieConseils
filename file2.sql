--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
	`account_id` int(10) UNSIGNED NOT NULL,
	`account_name` varchar(255) NOT NULL,
	`account_passwd` varchar(255) NOT NULL,
	`account_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
	ADD PRIMARY KEY (`account_id`),
	ADD UNIQUE KEY `account_name` (`account_name`);

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
	MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `account_sessions`
--

CREATE TABLE `account_sessions` (
	`session_id` varchar(255) NOT NULL,
	`account_id` int(10) UNSIGNED NOT NULL,
	`login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `plat` (
	`id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`nom` VARCHAR(60) NOT NULL,
	`description` TEXT(100) NOT NULL,
	`origine` ENUM('Europe', 'Amérique', 'Asie', 'Afrique', 'Océanie', 'Antarctique') NOT NULL,
	`type` ENUM('Petit-déjeuner', 'Déjeuner', 'Collation', 'Souper', 'Dessert') NOT NULL,
	`type2` ENUM('Sucré', 'Salé') NOT NULL,
	`pratique_alimentaire` ENUM('Carnivore', 'Flexitarien', 'Végétarien', 'Végétalien') NOT NULL,
	`lien_image` VARCHAR(100) NOT NULL
	);

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `account_sessions`
	ADD PRIMARY KEY (`session_id`);


INSERT INTO accounts (account_id, account_name, account_passwd, account_reg_time, account_enabled) VALUES
	('0', 'Jacky', '$2y$10$twVgCZe8wFvmKQF7kJjQ3.drugQLj3lWZ/6DfhnSUAZ4X2LjJRHz.', CURRENT_TIMESTAMP, '1');

INSERT INTO plat (id, nom, description, origine, type, type2, pratique_alimentaire, lien_image) VALUES
	('0', 'Lasagnes', 'Sans aucun doute le meilleur plat du monde, pas besoin d\'expliquer pourquoi, l\'incontournable plat de lasages est là !', 'Europe', 'Souper', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/15/6n2y.jpg'),
	('0', 'Ailerons de poulets', 'Cuisiné façon asiatique, un vrai délice, à manger avec les doigts, c\'est très conseillé !', 'Asie', 'Déjeuner', 'Salé', 'Carnivore', 'https://zupimages.net/up/21/16/v62f.jpg'),
	('0', 'Saumon asperges', 'Un filet de saumon avec un lit d\'asperges vertes avec sa sauce vinaigrette, un repas bien complet pour une journée bien chargée.', 'Europe', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/vtns.jpg'),
	('0', 'Humburger sauce poivre', 'Plat typiquement américain qui a presque la même saveur que ceux dans les fast-foods, mais en mieux.', 'Amérique', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/9gyb.jpg'),
	('0', 'Burritos', 'Plat originaire du méxique, il est idéal pour un repas complet avec des saveurs d\'ailleurs.', 'Amérique', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/c3i6.jpg'),
	('0', 'Brochettes de poulet', 'De simples brochettes de poulet à réchauffer au four plutôt qu\'au micro-ondes pour garder le goût de la marinade', 'Asie', 'Souper', 'Salé', 'Carnivore', 'https://zupimages.net/up/21/16/i669.jpg'),
	('0', 'Ecrasé de pommes de terre', 'Comme une purée mais c\'est pas pareil...', 'Europe', 'Déjeuner', 'Salé', 'Végétarien', 'https://zupimages.net/up/21/16/h6xm.jpg'),
	('0', 'Lasagnes de légumes', 'Le deuxième meilleur plat du monde, cette fois-ci aux légumes, avec des aubergines, des courgettes et pleins de bonnes choses, ça trompe l\'oeil non ?', 'Europe', 'Souper', 'Salé', 'Végétarien', 'https://zupimages.net/up/21/16/xpo6.jpg'),
	('0', 'Tarte aux kumquats', 'Jolie tarte non pas à l\'orange mais aux kumquats, des petits fruits amer et acides, mais le tout dans une tarte et ça fait un dessert tout sucré.', 'Europe', 'Dessert', 'Sucré', 'Végétarien', 'https://zupimages.net/up/21/16/rb9f.jpg'),
	('0', 'Pannequets au miel', 'Des pankakes si vous préférez, et tout ça avec un filet de miel pour que la journée commence en douceur.', 'Europe', 'Petit-déjeuner', 'Sucré', 'Végétarien', 'https://zupimages.net/up/21/16/00rt.jpg'),
	('0', 'Salade composée', 'Salade avec du thon, des oeufs, des pommes de terre sautées, des tomates, des olives noires, de la frisée, de la mâche, le tout avec une sauce à la moutarde', 'Europe', 'Déjeuner', 'Salé', 'Végétarien', 'https://zupimages.net/up/21/16/9ia1.jpg'),
	('0', 'Mochis au thé vert', 'Ces fameuses boules de farines fourrées venant du pays du soleil levant, vous ferras fondre !', 'Asie', 'Collation', 'Sucré', 'Végétalien', 'https://zupimages.net/up/21/16/7cil.jpg'),
	('0', 'Rôti de veau', 'Avec quelques champignons, mais l\'important, c\'est la cuisson de cette viande d\'exception qui la rend aussi tendre !', 'Europe', 'Souper', 'Salé', 'Carnivore', 'https://zupimages.net/up/21/16/bsod.jpg'),
	('0', 'Assiette de charcuterie', 'Petit plateau de charcuterie, principalement du jambon cru, et de fromages français.', 'Europe', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/3rrm.jpg'),
	('0', 'Tacos à la mexicaine', 'L\'original, le vrai tacos méxicain, léger, pas comme ceux que l\'on a dans nos fast-foods en France, celui-là est bien meilleur !', 'Amérique', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/q5as.jpg'),
	('0', 'Penne boulettes de viande', 'Une valeur sûre, des pâtes, des boulettes de viande avec sa sauce tomate, que demande le peuple ?', 'Europe', 'Déjeuner', 'Salé', 'Flexitarien', 'https://zupimages.net/up/21/16/yn6z.jpg'),
	('0', 'Penne pesto', 'Encore des pennes mais cette fois-ci végan, avec sa sauce pesto, ses petits légumes et son assaisonnement.', 'Europe', 'Déjeuner', 'Salé', 'Végétalien', 'https://zupimages.net/up/21/16/8aet.jpg'),
	('0', 'Spaguetti bolognaise', 'Le classique de tous les classiques, mais qu\'est ce que c\'est bon...', 'Europe', 'Souper', 'Salé', 'Végétalien', 'https://zupimages.net/up/21/16/rxft.jpg'),
	('0', 'Calzone margherita', 'Une pizza-sandwich ! Non plus sérieusement, c\'est un plat légendaire venant d\'Italie et tout le monde adore ça !', 'Europe', 'Souper', 'Salé', 'Végétarien', 'https://zupimages.net/up/21/16/dkub.jpg'),
	('0', 'Croquettes de fromage', 'Le Sirniki, plat méconnu mais très réputé au petit-déjeuner en Russie, se mange sans faim, c\'est irrésistible je vous l\'assure.', 'Asie', 'Petit-déjeuner', 'Sucré', 'Végétarien', 'https://zupimages.net/up/21/16/pp8u.jpg'),
	('0', 'Crêpe gourmande', 'Rien de mieux qu\'une bonne crêpe au chocolat avec de la chantilly et des fraises, un vrai bonheur de déguster ça pour faire le plein d\'énergie le matin !', 'Europe', 'Petit-déjeuner', 'Sucré', 'Végétarien', 'https://zupimages.net/up/21/16/mc5f.jpg'),
	('0', 'Tajine de légumes', 'Plat famillial qui sort de l\'ordinaire et qui fait du bien, autant au ventre qu\'au coeur...', 'Afrique', 'Souper', 'Salé', 'Végétarien', 'https://zupimages.net/up/21/16/n3un.jpg'),
	('0', 'Tartelette aux fruits rouges', 'Une petit bouchée de sucre qui fait du bien pour finir un repas.', 'Europe', 'Dessert', 'Sucré', 'Végétarien', 'https://zupimages.net/up/21/16/qs4m.jpg'),
	('0', 'Energy balls', 'Des petites boules d\'énergie pour recharger les batteries à tout moment de la journée ! Composées essentiellement de fruits à coque, attention aux allergies !', 'Amérique', 'Collation', 'Sucré', 'Végétalien', 'https://zupimages.net/up/21/16/k89w.jpg');