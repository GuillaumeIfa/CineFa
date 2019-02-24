<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./SCRIPT/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<title>Acteurs</title>
</head>
<body>
	<h1>Acteurs</h1>
	<i class="fas fa-theater-masks" style="font-size: 60px;"></i>
	<br>
	<br>
	 <form action="./acteurs.php" method="POST">

		Recherche:<br>
		<input type="text" name="name">
		<br>
		<i class="fas fa-search"></i>
		<input type="submit" name="submit" value="Rechercher">

	</form>
	<br><span>Liste des acteurs:</span>
	<?php 

		require_once './SCRIPT/configure.php';
		include './SCRIPT/functions.php';

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