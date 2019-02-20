<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<title>Réalisateurs</title>
</head>
<body>
	<?php 

		echo '<h1>Réalisateurs</h1>';

		require_once './configure.php';
		include './functions.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name ='cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{

			if (isset($_POST['submit']))
			{
				$name = $_POST['name'];

				$rqt_directors =
				'
				SELECT *
				FROM directors
				WHERE name LIKE "%'.$name.'%";
				';
			}
			else
			{
				$rqt_directors = 
				'
				SELECT * 
				FROM directors;
				';
			}

			$result_query = mysqli_query($db_handle, $rqt_directors);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<a href="fiche_realisateur.php?id='.$db_field['id_director'].'&name='.$db_field['name'].'">'.ucwords($db_field['name']).'</a><br>';
			}		
		}
		echo '<br>';
	 ?>
	  <form action="./realisateurs.php" method="POST">

	 	Recherche:
	 	<input type="text" name="name">
	 	<br><br>
	 	<input type="submit" name="submit" value="Rechercher">

	 </form>
	 <?php echo '<br><a href="./index.tmp.php">Retour</a>'; ?> 
</body>
</html>