<?php
require_once ROOT.DS."models".DS."module_content.php";
require_once ROOT.DS."libraries".DS."FormProcessor".DS."FormProcessor_Content.php";

class ConContent extends ModContent {
    
    
    function takeContent($view_param, $page_id = null){
        $result = $this->select($view_param,$page_id);
        
        return $result;
    }
    
    function __construct(){
        parent::__construct();
        
        $action = (isset($_GET['action'])) ? $_GET['action'] : null;
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        
        if(strlen($action) > 0)    {
            $this->manageAction($action, $id);
        }
    }
    
    function cCreate($post){
        if(isset($post['create'])){
            $_SESSION['errors'] = null;
            
            
            $processor = new FormProcessor_Content();
            $processor->processor($post);
        }
        
        
        $_POST = $post = null;
        return require_once ROOT.DS.'views'.DS.'backend'.DS.'content'.DS.'create_tpl.php';
    }
    
    
    function manageAction($action, $id){
       switch($action){
        case('visibleYes'):
            $visible = 1;
            if (!$this->visible($id,$visible)) {
                echo 'Errore nel cambiamento di stato della pagina';
            } else {
                header("Location: admin.php?content");
            }
        break;
        case('visibleNo'):
            $visible = 0;
            if (!$this->visible($id,$visible)) {
                echo 'Errore nel cambiamento di stato della pagina';
            } else {
                header("Location: admin.php?content");
            }
        break;
        case('edit'):
            /*$menu_item = $this->selectOne($id);
            
            echo '
                <form method="POST" action="">
                    <p>Nome pagina: <input type="text" name="menu_name" value="'.$menu_item->page_name.'"/></p>
                    <br>
                    <p>Title della pagina: <input type="text" name="menu_title" value="'.$menu_item->page_title.'"/>   </p>
                    <br>
                    <input type="submit" name="edit" value="Modifica"/>
                </form>';
                
                    if($_POST['edit']){
                        $page_name = $_POST['menu_name'];
                        $page_title = $_POST['menu_title'];
                        
                        if(!$this->edit($id,$page_name,$page_title)){
                                header("Location: admin.php?content&message=Errore!!! Pagina non Modificata !");
                                return false;
                        } else {
                            header("Location: admin.php?content&message=Pagina Modificata !");
                        }
                    }
              */
            echo 'Ancora in realizzazione ...';
        break;
        case('delete'):
            if(!$this->delete($id)){
                header("Location: admin.php?content&message=Errore!!! Pagina non Eliminata !");
            } else {
                header("Location: admin.php?content&message= Pagina Eliminata!");
            }
        break;
        case('create');
            $this->cCreate($_POST);
        break;
        }
    }
    
}




?>

