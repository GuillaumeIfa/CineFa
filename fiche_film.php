<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./CSS/style.css">
	<title><?php echo ucwords($_GET["name"])?></title>
</head>
<body>
	<h1><?php echo ucwords($_GET["name"])?></h1>
	<?php 

		require_once './configure.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name = 'cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{

			$rqt_movies =
			'
			SELECT *
			FROM movies
			INNER JOIN directors ON directors.id_director = movies.id_director
			WHERE movies.id_movie = "'.$_GET["id"].'";
			';

			$rqt_actors = 
			'
			SELECT actors.name, actors.id_actor
            FROM actors
            INNER JOIN plays_in ON plays_in.id_actor = actors.id_actor
            INNER JOIN movies ON movies.id_movie = plays_in.id_movie
            WHERE movies.id_movie = '.$_GET["id"].';
            ';

			$result_query_movies = mysqli_query($db_handle, $rqt_movies);
			$db_field_movies = mysqli_fetch_assoc($result_query_movies);

			echo '<h3>Informations:</h3>';
			echo '<p>Date de sortie<br>';
			echo $db_field_movies['release_date'].'</p><br>';
			echo '<p>Réalisateur:<br>';
			echo '<a href="fiche_realisateur.php?id='.$db_field_movies["id_director"].'&name='.$db_field_movies["name"].'">'.ucwords($db_field_movies["name"]).'</a><br>';

			$result_query_actors = mysqli_query($db_handle, $rqt_actors);

			echo '<p>Acteurs:</p><br>';

			while ($db_field_actors = mysqli_fetch_assoc($result_query_actors)) 
			{
				echo '<a href="fiche_acteur.php?id='.$db_field_actors["id_actor"].'&name='.$db_field_actors["name"].'">'.ucwords($db_field_actors["name"]).'</a><br>';
			}
		}
	 ?>
	 <h2>Notez Le film:</h2>

<!-- 	 <?php 
/*	 	if (isset($_SESSION['pseudo'])) 
	{
		echo $_SESSION['pseudo'];
	}*/
?> -->

	 <form action="" method="POST">
	 	<input type="radio" name="note" value="5">5<br>
	 	<input type="radio" name="note" value="4">4<br>
	 	<input type="radio" name="note" value="3">3<br>
	 	<input type="radio" name="note" value="2">2<br>
	 	<input type="radio" name="note" value="1">1<br>
	 	<input type="radio" name="note" value="0">0<br><br>
	 	<input type="submit" name="submit_note">
	 </form>

	 <?php 

	 	if (isset($_POST['submit_note'])) 
	 	{
	 		if (!isset($_SESSION['pseudo'])) 
	 		{
	 			echo '<br><b>Veuillez vous connecter </b><a href="./connection.php">ICI</a>';
	 		}
	 		else
	 		{
	 			if ($db) 
	 			{
	 				$note = $_POST['note'];
	 				$id_movie = $_GET['id'];
	 				$id_user = $_SESSION['id_user'];

	 				$rqt_note = 
	 				'
					INSERT INTO movie_notes
					(
					id_movie, id_user, note
					)
					VALUES
					(
					"'.$id_movie.'","'.$id_user.'","'.$note.'"
					);
	 				';

	 				$result_query_note = mysqli_query($db_handle, $rqt_note);

	 				if ($result_query_note) 
	 				{
	 					echo 'Vous avez noté le flim !';
	 				}
	 			}
	 		}
	 	}
	 	echo '<br><a href="./index.tmp.php">Retour</a>';
	  ?>
</body>
</html>