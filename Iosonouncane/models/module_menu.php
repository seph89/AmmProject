<?php
require_once ROOT.DS."libraries".DS."Database_Driver".DS."Mysqlimproved_Driver.php";

class ModMenu {
	var $view_param;
	private $mysqli = null;
	private $dbTable;
	
	function __construct(){
		$this->mysqli = new Mysqlimproved_Driver();
		
		$this->dbTable = 'mvc_menu';
	}
	
	/**
	*	Funzione che estrae i dati in base alla visualizzazione necessaria
	*	
	*	@view_param 	string 		Decide quale visualizzazione adattare
	*/
	function selectMenu($view_param){	
		switch($view_param){
			case('frontend'):
				$this->mysqli->prepare("SELECT * FROM {$this->dbTable} WHERE menu_visible = '1' ORDER BY menu_position");
			break;	
			case('backend'):
				$this->mysqli->prepare("SELECT * FROM {$this->dbTable} ORDER BY menu_position");
			break;	
		}
		
		$this->mysqli->query(); // esegue la query
		return $this->mysqli->fetch('all_assoc'); // formatta tutti i dati in un array associativo
	}
	
	function selectOneMenu($id){		
		$id = $this->mysqli->escape($id); // ripulisce da simboli speciali
		$this->mysqli->prepare("SELECT menu_name, menu_title FROM {$this->dbTable} WHERE menu_id='{$id}'"); // preparare una query
		$this->mysqli->query(); // esegue la query
		
		return $this->mysqli->fetch(); // formatta i dati in oggetto
	}
        
	//Metodo per cambiare la visibilità di un punto menu
        
	function visibleMenu($id,$visible){
		if(!$id) return false;
		if($visible > 1) return false;
		
		$id = $this->mysqli->escape($id); 
		
		if($visible == 0){
			$this->mysqli->prepare("UPDATE {$this->dbTable} SET menu_visible = '0' WHERE menu_id = '{$id}'");
		} else {
			$this->mysqli->prepare("UPDATE {$this->dbTable} SET menu_visible = '1' WHERE menu_id = '{$id}'");
		}	
		$this->mysqli->query();		// esegue la query
		
		return true;
	}
	
        //Metodo per modificare un punto menu
        
	function editMenu($id,$menu_name,$menu_title){
		if(!$id) return false;
		if(!$menu_name || !$menu_title) return false;
		
		$id = $this->mysqli->escape($id); // pulisce  id
		
		$this->mysqli->prepare("UPDATE {$this->dbTable} SET menu_name = '{$menu_name}',menu_title = '{$menu_title}' WHERE menu_id = '{$id}'");
		
		$this->mysqli->query(); // eseguimo la query
		
		return true;
	}
        
	//Metodo per eliminare un punto menu
	function deleteMenu($id) {
		$this->mysqli->prepare("DELETE FROM {$this->dbTable} WHERE menu_id = '{$id}'");
		
		$this->mysqli->query(); // esegue la query
		
		return true;
	}
	
	//Metodo per creare un nuovo punto menu
	
	function createMenu($menu_id, $menu_name, $menu_title, $menu_visible, $menu_position){
		$this->mysqli->prepare("INSERT INTO {$this->dbTable} (menu_id, menu_name, menu_title, menu_visible, menu_position) 
					VALUES ('$menu_id', '$menu_name', '$menu_title', '$menu_visible', '$menu_position')");
		
		$this->mysqli->query(); // eseguimo la query
		
		return true;
	}
}
?>
