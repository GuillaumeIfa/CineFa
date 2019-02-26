<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./SCRIPT/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<title>Categories</title>
</head>
<body>
	<h1>Catégories</h1>
	<i class="fas fa-list-alt" style="font-size:60px;"></i>
	<br><br>
	<?php 

		require_once './SCRIPT/configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db && $_SESSION["id_user"])
		{

			$rqt_categories =
			'
			SELECT *
			FROM categories
			WHERE id_user = ' .$_SESSION["id_user"]. ';
			';

			$result_query_categories = mysqli_query($db_handle, $rqt_categories);

			if ($result_query_categories) 
			{
				while ($db_field_categories = mysqli_fetch_assoc($result_query_categories)) 
				{
					echo '<p>Titre: <a href="./categorie_content.php?id='.$db_field_categories['id_category'].'&&title='.$db_field_categories['title'].'">'.$db_field_categories["title"].'</a><br>';
					echo 'Créée le '.$db_field_categories["creation_date"].';</p>';
				}
			}
			else
			{
				echo 'Vous n\'avez pas encore de créé(e) de catégories...<br>';
			}
		}
		else
		{
			echo 'Oupss ! Vous n\'êtes pas connecté(e) !';
		}

		echo '<br><a href="./creation_categorie.php"><button class="button">Créer une nouvelle catégorie</button></a>';
		echo '<a href="./suppression_categorie.php"><button class="button">Supprimer une catégorie</button></a>';

	 ?>
	<br><br>
	<a href="./index.tmp.php">Retour</a>
</body>
</html>