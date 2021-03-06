<?php
error_reporting ( E_ALL | E_STRICT );
ini_set ( "display_errors", 1 );
header('Content-Type: text/html; charset=UTF-8');

	if (!defined('__ROOT__'))
    define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . "/core/Model.php");
require_once(__ROOT__ . "/core/Mysql.php");

 session_start();
 
 class Edita extends Model { 
 	
   private $table;
   private $db;
   private $where;
   private $fields;
   
   protected $rs ;
	protected $rs_detalle ;
	protected $rs_imagenes ;
	protected $rs_usuario ;
	
	private  $id_usuario ;
	private  $id_evento ;   
   
   //Inicizalizacion y destruccion del objeto   
   function __construct( $idUsuario, $idEvento) {
   	$this->id_usuario = $idUsuario ;
		$this->id_evento  = $idEvento;
	
		$this->table[] = "ListaUsuarios";
      $this->table[] = "evento";        
      $this->table[] = "detalle_evento";
      $this->table[] = "galeriaimagenes";
                
      $this->fields[] = "*"; 
      $this->fields[] = "*"; 
      $this->fields[] = "*";         
		$this->fields[] = "*";
        
        $this->db         = new MySQL();
        
        if ($this->db->error) {
            //header("Location: ".$this->PATH_ERROR."1");
            echo "No se puede establecer conexión con la base de datos";
            exit;
        }
    }
    
   function __destruct() {}
   
   function get_rsImagenesEvento () {
   	$this->rs_imagenes = $this->get_rows(3," evento  = ".$this->id_evento );   	
		return $this->rs_imagenes;   	
   }
   
   function get_rsDetalleEvento () {
   	$this->rs_detalle = $this->get_rows(2," evento  = ".$this->id_evento );   	
		return $this->rs_detalle;   	
   }
   
    function get_rsEvento () {
   	$this->rs = $this->get_rows(1," id = ".$this->id_evento );   	
		return $this->rs;   	
   }
   
   function get_rsUsuarios () {
   	$this->rs_usuario = $this->get_rows(0," id_usuario = ".$this->id_usuario );
		return $this->rs_usuario;   	
   }
   
  
   
   
 	private function get_rows($categoria, $where_str = false, $order_str = false) {
        $where_str = $where_str ? "$where_str " : "";
        $order_str = $order_str ? "$order_str " : "";
        
        $rst = $this->getlist($this->db, $this->table[$categoria], $this->fields[$categoria], $where_str, $order_str);
        return $rst;
   }
       
   
 }

?>