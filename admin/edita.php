<?php
error_reporting ( E_ALL | E_STRICT );
ini_set ( "display_errors", 0 );

header('Content-Type: text/html; charset=UTF-8');              	

//require "revisar/GestorArchivos.php";
require "revisar/config.php"; 
require_once("revisar/comunes.php");
                      	
 	             	
$conexion = new mysqli($servidor, $usuarioBD, $passwordBD, $baseDatos);
//Actualiza datos del evento                
if(isset($_POST['submit_update_Evento'])){
    	ob_start();
    	
	$idevento = $_POST["id_evento"];
 	echo "idevento->" .$idevento."<br>";
 	   
    	
 	$evento = $_POST["evento"];
 	echo "evento->" .$evento."<br>";
 	
 	
 	$descripcion = $_POST["descripcion"];
 	echo "descripcion->" .$descripcion ."<br>";
 	
 	$fecha = $_POST["date"];
 	echo "fecha->" .$fecha ."<br>";
 	
 	$activo = $_POST["activo"];
 	echo "activo->" .$activo ."<br>";
 	 	
 										 
 	$SonValidos=validadatosEvento($idevento, $evento , $descripcion, $fecha,$activo);
 	echo "Resultado de SonValidos".$SonValidos."<br>";
 	
 	if ( $SonValidos == 1 ){ 		
 		$procesa=UpdateEvento( $idevento, $evento, $descripcion, $fecha,$activo,$conexion);
 		echo "<br>Resultado deActualizacion-> ".$procesa."<br>"; 		
 		if ($procesa > 0 )  {
 			ob_end_clean(); 
 			header ("Location:admin_edita.php?id_evento=".$idevento."&msg='Datos del Evento Actualizados'");
 		}
 		else 
 			echo "<br>No se confirmo el proceso, revise la pila de msgs en la pagina <br><a href='admin_edita.php?id_evento'".$idevento."> Regresar</a>";   
 	}
 	else { 
		echo "No se ha confirmado la operación(DATOS INCOMPLETOS), vuelva a intentarlo".$SonValidos."</br>";
		echo "<a href='admin_edita.php?id_evento'".$idevento."> Regresar</a>";                	
 	}
                	
						
                	
                	//$fecha = $_POST["bdate"];                                      
                  //subirImagenesConEvento($folder,$conexion,$evento , $descripcion, $fecha, $idEvento);
}
//Actualiza detalles del evento 

if(isset($_POST['submit_update'])){
    	
   ob_start(); 	
	$idevento = $_POST["id_evento"];
 	echo "idevento->" .$idevento."<br>";
 	   
    	
 	$tags = $_POST["tags"];
 	echo "evento->" .$tags."<br>";
 	
 	
 	$idMunicipio = $_POST["idMunicipio"];
 	echo "idMunicipio->" .$idMunicipio ."<br>";
 	
 	$location_search = $_POST["location_search"];
 	echo "location_search ->" .$location_search  ."<br>";
 	
 	
 	 	
 										 
 	$SonValidos=validadatosDetalle($idevento, $tags , $location_search );
 	echo "Resultado de SonValidos".$SonValidos."<br>";
 	
 	if ( $SonValidos == 1 ){ 		
 		$procesa=UpdateDetalles( $idevento, $tags, $location_search,$conexion);
 		echo "<br>Resultado deActualizacion-> ".$procesa."<br>"; 		
 		if ($procesa > 0 ){
 			ob_end_clean();    
 			header ("Location:admin_edita.php?id_evento=".$idevento."&msg='Datos del Evento Actualizados'");
 		}
 		else 
 			echo "<br>No se confirmo el proceso, revise la pila de msgs en la pagina <br><a href='admin_edita.php?id_evento'".$idevento."> Regresar</a>";   
 	}
 	else { 
		echo "No se ha confirmado la operación(DATOS INCOMPLETOS), vuelva a intentarlo".$SonValidos."</br>";
		echo "<a href='admin_edita.php?id_evento=".$idevento."'> Regresar</a>";                	
 	}
                	
}						

 //Agrega imágenes  

if(isset($_POST['submit_files'])){
    	
   ob_start();
    	
	$idevento = $_POST["id_evento"];
 	echo "idevento->" .$idevento."<br>";
 	   
    	
 	$folder = $_POST["folder"];
 	echo "folder->" .$folder."<br>";
 	
 	$SonValidos=validadatosUpImagenes($idevento, $folder );
 	echo "Resultado de SonValidos".$SonValidos."<br>";
 	
 	if ( $SonValidos == 1 ){ 		
 		$procesa=ProcesaImagenes( $idevento, $folder, $conexion);
 		echo "<br>Resultado deActualizacion-> ".$procesa."<br>";	 		
 		if ($procesa > 0 ){ 
 			ob_end_clean(); 			  
 			header ("Location:admin_edita.php?id_evento=".$idevento);
 			echo "Algo salio mal...</br>";
			echo "<a href='admin_edita.php?id_evento=".$idevento."'> Regresar</a><br>";
 		}
 		else 
 			echo "<br>No se confirmo el proceso, revise la pila de msgs en la pagina <br><a href='admin_edita.php?id_evento=".$idevento."'> Regresar</a>";   
 	}
 	else { 
		echo "No se ha confirmado la operación(DATOS INCOMPLETOS), vuelva a intentarlo".$SonValidos."</br>";
		echo "<a href='admin_edita.php?id_evento=".$idevento."'> Regresar</a>";                	
 	}
                            	
                
}
?>