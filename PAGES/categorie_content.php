 <?php

	require_once '../SCRIPT/configure.php';

	$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
	$db_name = 'cinefa';
	$db = mysqli_select_db($db_handle, $db_name);

	if ($db)
	{
		if (isset($_POST['submit_movie']))
		{
			$id_movie = $_POST['film'];
			$id_category = $_GET['id'];

			$rqt_add_content =
			'
			INSERT INTO category_content
			(
			id_movie, id_category
			)
			VALUES
			(
			"'.$id_movie.'","'.$id_category.'"
			);
			';

			$result_query = mysqli_query($db_handle, $rqt_add_content);
			if ($result_query)
			{
				echo '<script>alert("Le film a bien été ajouté !")</script>';
			}
			else
			{
				echo '<script>alert("Le film a déjà été ajouté !")</script>';
			}
		}
	}

	if ($db)
	{
		if (isset($_POST['delete_movie']))
		{
			$id_movie = $_POST['film'];
			$id_category = $_GET['id'];

			$rqt_delete_content =
			'
			DELETE FROM category_content
			WHERE id_movie = "'.$id_movie.'" AND id_category = "'.$id_category.'"
			';

			$result_query = mysqli_query($db_handle, $rqt_delete_content);
			if ($result_query)
			{
				echo '<script>alert("Le film a bien été supprimé !")</script>';
			}
		}
	}
	mysqli_close($db_handle);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../SCRIPT/style.css">
	<title><?php echo ucwords($_GET["title"])?></title>
</head>
<body>
	<div class="conteneur">
		<h1><?php echo ucwords($_GET["title"])?></h1>

		<?php 

			require_once '../SCRIPT/configure.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			$db_name = 'cinefa';
			$db = mysqli_select_db($db_handle, $db_name);

			if ($db) 
			{
				$rqt_content =
				'
				SELECT * FROM category_content
				INNER JOIN movies ON movies.id_movie = category_content.id_movie
				WHERE id_category = '.$_GET['id'].';
				';

				$result_query_content = mysqli_query($db_handle, $rqt_content);

				if ($result_query_content)
				{
					while ($db_field_content = mysqli_fetch_assoc($result_query_content)) 
					{
						echo '<p><a href="./fiche_film.php?id='.$db_field_content['id_movie'].'&&name='.$db_field_content['title'].'">'.ucwords($db_field_content["title"]).'</a><br>';
					}
				}
				else
				{
					echo 'Cette categorie est vide';
				}
			}
			mysqli_close($db_handle);
		 ?>


		<h3>Ajouter un film à cette catégorie:</h3>

		<form action="" name="form1" method="POST">
			<input type="text" name="title">
			<br>
			<input class="button" type="submit" name="submit" value="Rechercher">
			<br>
		</form>

		<form action="" name="form2" method="POST">

		<?php

			require_once '../SCRIPT/configure.php';
			include '../SCRIPT/functions.php';

			$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
			$db_name ='cinefa';
			$db = mysqli_select_db($db_handle, $db_name);

			if($db)
			{
				if (isset($_POST['submit']))
				{
					$title = $_POST['title'];

					$rqt_movies =
					'
					SELECT *
					FROM movies
					WHERE title LIKE "%'.$title.'%";
					';
				}
				else
				{
					$rqt_movies = 
					'
					SELECT * 
					FROM movies;
					';
				}

				$result_query_movies = mysqli_query($db_handle, $rqt_movies);

				while ($db_field_movies = mysqli_fetch_assoc($result_query_movies)) 
				{
					echo '<br><input type="radio" name="film" value="'.$db_field_movies['id_movie'].'">'.ucwords($db_field_movies['title']).'</input>';
				}
			}
			mysqli_close($db_handle);
		?>
			<br><br>
			<input class="button" type="submit" name="submit_movie" value="Ajouter">
			<input class="button" type="submit" name="delete_movie" value="Supprimer">

		</form>

		<br>
		<a href="./categories.php">Retour</a>
	</div>
</body>
</html>