<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<title>Films</title>
</head>
<body>
	<h1>Films</h1>
	<form action="./films.php" method="POST">

		Recherche par titre:<br>
		<input type="text" name="title">
		<br>
		<input type="submit" name="submit" value="Rechercher">

	</form>
	<br><span>Liste des films:</span><br>
	<?php

		require_once './configure.php';
		include './functions.php';

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


			$result_query = mysqli_query($db_handle, $rqt_movies);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<br><a href="fiche_film.php?id='.$db_field['id_movie'].'&name='.$db_field['title'].'">'.ucwords($db_field['title']).'</a>';
			}
		}
		echo '<br>';
		echo '<br><a href="./index.tmp.php">Retour</a><br>';

		if (isset($_SESSION['pseudo']) && isset($_SESSION['password']))
		{
			echo '<br><h2>Bonjour '.$_SESSION['pseudo']. ' !</h2><br>';
		}
	 ?>
</body>
</html>