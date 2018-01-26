<?php 
$value="$10,50";

	$precio = floatval(explode ("$", $value)[1]);
	echo $precio +0.01
?>