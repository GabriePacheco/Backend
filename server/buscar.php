<?php
/******************** Buscador php *****************************/
//Programa filtra el archivo data-1.json segun campos en el index
/*****************************************************************/
//------------------------- indice--------------------------------
//1 . - Almaceno el archivo en variale y lo trasformo en Json! 
//2. - Si en la solictus no existen campos almaceno tosdos los registros  en un arreglo  
//3.- Almaceno los registros filtrados por CIUDAD , TIPO, PRECIO
//4.- Almaceno los registros filtrados por solo por  PRECIO
//5.- Almaceno los registros filtrados por solo por  Ciudad y PRECIO
//6.- Almaceno los registros filtrados por solo por  TIPO y PRECIO
//7. SI no se obtubieron resultados Almaceno un mensaje Y/O RETORNO EL RESULTADO 
/*****************************************************************/
/*****************************************************************/

	//1 . - Almaceno el archivo en variale y lo trasformo en Json! 
	$data= file_get_contents("../data-1.json");
	$casas = json_decode($data, true);
	$filtrado=[];

	//2. - Si en la solictus no existen campos almaceno tosdos los registros  en un arreglo  
	if ($_GET['Ciudad']=="no" && $_GET['Tipo']=="no" && $_GET['rangod']=="no"){
		foreach ($casas as $key => $value) {
				$filtrado[$key]=$value;
		}
	}	

	//3.- Almaceno los registros filtrados por CIUDAD , TIPO, PRECIO
	if ($_GET['Ciudad']!="no" && $_GET['Tipo']!="no"){
		$cont=0;
		foreach ($casas as $key => $value) {
			$precio = str_replace("$", "", $value['Precio']);
			$precio = str_replace(",", "", $precio);
			$precio = floatval($precio);
			if ($value['Ciudad']==$_GET['Ciudad'] && $value['Tipo']==$_GET['Tipo']	&& $precio >= floatval($_GET['rangod']) && $precio <=  floatval($_GET['rangoh'])  ){
				$filtrado[$cont]=$value;
				$cont++;
			}
		}

	}

	//4.- Almaceno los registros filtrados por solo por  PRECIO
	if ($_GET['Ciudad']=="no" && $_GET['Tipo']=="no"){
		$cont=0;
		foreach ($casas as $key => $value) {
			$precio = str_replace("$", "", $value['Precio']);
			$precio = str_replace(",", "", $precio);
			$precio = floatval($precio);
			if  ($precio >= floatval($_GET['rangod']) && $precio <=  floatval($_GET['rangoh'])  ){
				$filtrado[$cont]=$value;
				$cont++;
			}
		}

	}

	//5.- Almaceno los registros filtrados por solo por  Ciudad y PRECIO
	if ($_GET['Ciudad']!="no" && $_GET['Tipo']=="no"){
		$cont=0;
		foreach ($casas as $key => $value) {

			$precio = str_replace("$", "", $value['Precio']);
			$precio = str_replace(",", "", $precio);
			$precio = floatval($precio);
			if ($value['Ciudad']==$_GET['Ciudad'] && $precio >= floatval($_GET['rangod']) && $precio <=  floatval($_GET['rangoh'])  ){
				$filtrado[$cont]=$value;
				$cont++;
			}
		}

	}

	//6.- Almaceno los registros filtrados por solo por  TIPO y PRECIO
	if ($_GET['Ciudad']=="no" && $_GET['Tipo']!="no"){
		$cont=0;
		foreach ($casas as $key => $value) {

			$precio = str_replace("$", "", $value['Precio']);
			$precio = str_replace(",", "", $precio);
			$precio = floatval($precio);
			if ($value['Tipo']==$_GET['Tipo'] && $precio >= floatval($_GET['rangod']) && $precio <=  floatval($_GET['rangoh'])  ){
				$filtrado[$cont]=$value;
				$cont++;
			}
		}

	}

	//7. SI no se obtubieron resultados Almaceno un mensaje Y/O RETORNO EL RESULTADO 
	if ( !$filtrado ){
		$filtrado["mensaje"]= "No se encontraron resultados";
		echo  json_encode($filtrado);
	}else{
		echo  json_encode($filtrado);
	}
?> 