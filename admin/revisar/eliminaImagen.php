<?php 


if (!isset($_GET['id'])) {
    echo "Parámetros incorrectos ".$_GET['id'];
}
else {
	require 'config.php'; 
	$conexion = new mysqli($servidor, $usuarioBD, $passwordBD, $baseDatos);                 
	$borra = "DELETE FROM galeriaimagenes WHERE id = ".$_GET['id'].";";	
   $resultado = $conexion->query($borra);
   
   //echo $borra."</br>";
   //echo $resultado."</br>" ;  
   //Redireccionar a la pagina de login
   
   if ( $resultado ) {
   	//echo $_GET['evento']."</br>" ;  
		header ("Location:../admin_edita.php?id_evento=".$_GET['evento']);   
   }
   else { 
   	echo "No se ha confirmado la operaci�n, vuelva a intentarlo, Si las fallas continuan contacte a Administrador</br>";
   	echo "<a href='main.php'> Regresar</a>";
   }
	
}
	
 
?>