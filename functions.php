<?php 

	function trimmer($x)
	{
		$x = htmlentities($x);
		$x = trim($x);
		$x = str_replace(' ', '_', $x);

		return $x;
	}

 ?>