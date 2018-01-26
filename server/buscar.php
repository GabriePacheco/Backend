<?php

	$data= file_get_contents("../data-1.json");
	$casas = json_decode($data, true);

	$cont=0;
	foreach ($casas as $key => $value) {
		$filtrado[$key]=$value;
	
	}
	echo  json_encode($filtrado);
?> 