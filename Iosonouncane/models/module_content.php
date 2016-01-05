<?php
require_once ROOT.DS."libraries".DS."Database_Driver".DS."Mysqlimproved_Driver.php";

class ModContent {
	private $dbTable;
	private $mysqli = null;
	
	function __construct(){
            $this->mysqli = new Mysqlimproved_Driver();

            $this->dbTable = 'mvc_page';
	}
	/* Funzione di estrazione dati in base al page_id
	*/
	function select($view_param, $page_id){ 
		
		switch($view_param){
			case('frontend'):
				$this->mysqli->prepare("SELECT * FROM {$this->dbTable} WHERE page_id='{$page_id}'  AND active = '1'");
				
				$this->mysqli->query(); // esegue la query
				return $this->mysqli->fetch('assoc'); // formatta la riga in un array associativo
			break;	
			case('backend'):
				$this->mysqli->prepare("SELECT * FROM {$this->dbTable} ORDER BY page_id ASC");
				
				$this->mysqli->query(); // esegue la query
				return $this->mysqli->fetch('all_assoc'); // formatta tutti i dati in un array associativo
			break;	
		}
	}
	
	function selectOne($id){		
		$id = $this->mysqli->escape($id); // ripulisce da simboli speciali
		$this->mysqli->prepare("SELECT * FROM {$this->dbTable} WHERE menu_id='{$id}'"); // prepara una query
		$this->mysqli->query(); // esegue la query
		
		return $this->mysqli->fetch(); // formatta i dati in oggetto
	}
	
        //Metodo per modificare la visibilità di un Contenuto
	function visible($id,$visible){
		if(!$id) return false;
		if($visible > 1) return false;
		
		$id = $this->mysqli->escape($id); 
		
		if($visible == 0){
			$this->mysqli->prepare("UPDATE {$this->dbTable} SET active = '0' WHERE page_id = {$id}");
		} else {
			$this->mysqli->prepare("UPDATE {$this->dbTable} SET active = '1' WHERE page_id = {$id}");
		}	

		$this->mysqli->query();		// esegue la query
		
		return true;
	}
	
	function edit($id,$data){
		/*if(!$id) return false;
		if(!$menu_name || !$menu_title) return false;
		
		$id = $this->mysqli->escape($id); 
		
		$this->mysqli->prepare("UPDATE {$this->dbTable} SET menu_name = '{$menu_name}',menu_title = '{$menu_title}' WHERE menu_id = {$id}");
		
		$this->mysqli->query(); // esegue la query
		
		return true;*/
	}
	
        //Metodo per eliminare un Contenuto
        
	function delete($id) {
		$this->mysqli->prepare("DELETE FROM {$this->dbTable} WHERE page_id = {$id}");
		
		$this->mysqli->query(); // esegue la query
		
		return true;
	}
	
	
        //Metodo per creare un nuovo Contenuto
	
        function create($page_id, $keywords, $description, $title, $titleText, $pageText, $active = 1){
            $this->mysqli->prepare("INSERT INTO {$this->dbTable} 
                (page_id, page_keywords, page_description, page_title, page_titleText, page_text, active) 
                VALUES ('{$page_id}', '{$keywords}', '{$description}', '{$title}', '{$titleText}', '{$pageText}', '{$active}')");

            $this->mysqli->query(); // esegue la query

            return true;
	}
}
?>