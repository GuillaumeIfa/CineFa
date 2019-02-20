<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
	<title>Acteurs</title>
</head>
<body>
	<h1>Acteurs</h1>
	 <form action="./acteurs.php" method="POST">

		Recherche:
		<input type="text" name="name">
		<br><br>
		<input type="submit" name="submit" value="Rechercher">

	</form>
	<br><span>Liste des acteurs:</span><br>
	<?php 

		require_once './configure.php';
		include './functions.php';

		$db_handle = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
		$db_name ='cinefa';
		$db = mysqli_select_db($db_handle, $db_name);

		if($db)
		{
			$name ='';

			if (isset($_POST['submit']))
			{
				$name = $_POST['name'];

				$rqt_actors =
				'
				SELECT *
				FROM actors
				WHERE name LIKE "%'.$name.'%";
				';
			}
			else
			{
				$rqt_actors = 
				'
				SELECT * 
				FROM actors;
				';
			}

			$result_query = mysqli_query($db_handle, $rqt_actors);

			while ($db_field = mysqli_fetch_assoc($result_query)) 
			{
				echo '<br><a href="fiche_acteur.php?id='.$db_field['id_actor'].'&name='.$db_field['name'].'">'.ucwords($db_field['name']).'</a>';
			}		
		}
		echo "<br>";
	 ?>
	<?php echo '<br><a href="./index.tmp.php">Retour</a>'; ?>
</body>
</html>