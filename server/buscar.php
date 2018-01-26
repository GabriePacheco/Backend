<?php

	$data= file_get_contents("../data-1.json");
	$casas = json_decode($data, true);
	if ($_GET['Ciudad']=="no" && $_GET['Tipo']=="no" && $_GET['rangod']=="no"){
		foreach ($casas as $key => $value) {
				$filtrado[$key]=$value;
		}
	}	
	if ($_GET['Ciudad']!="no" && $_GET['Tipo']!="no"){
		$cont=0;
		foreach ($casas as $key => $value) {

			$precio = floatval(preg_replace(",","", explode ("$", $value['Precio'])[1]));

			if ($value['Ciudad']==$_GET['Ciudad'] && $value['Tipo']==$_GET['Tipo']	&& $precio >= floatval($_GET['rangod']) && $precio <=  floatval($_GET['rangoh'])  ){
				$filtrado[$cont]=$value;
				$cont++;


			}
		}

	}
	echo  json_encode($filtrado);
?> 