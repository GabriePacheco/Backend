<?php

	$data= file_get_contents("../data-1.json");
	$casas = json_decode($data, true);
	if (isset($_GET['menu'])){
		$encuentra = $_GET['menu'];

	}else{
		echo "Error : no hay parametros ";
	}
	$menu=[];

	foreach ($casas as $key => $value) {
		if (! in_array($value[$encuentra], $menu)){
			$menu[$key]=$value[$encuentra];
		}
	
	}
	
	foreach ($menu as $key => $value) {
		echo "<option value='".$value."' >".$value."</option>";
	}
?> 