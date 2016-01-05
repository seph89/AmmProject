<?php
    class UserController{
        
        function UserController(){   //costruttore
            //vuoto
        }
        
        function create($username,$password,$email){
            //crea un utente
        }
        function login($username, $password){
            
            //controlla nel database, esegue il login
            if($this->authenticate($username,$password)){
                //inizia la sessione per l'utente
                session_start();
                //istanzia l'oggetto UserModel
                $user = new UserModel($username);
                //setta l'utente alla sessione
                $_SESSION['user'] = $user;
                //diciamo al sistema che abbiamo autenticato l'utente
                return true;
            }else{
                //diciamo al sistema che non possiamo autenticare l'utente
                return false;
            }
        }
        
        static function authenticate($u, $p){
            $authentic = false;
            //verifica i dati
            if($u == 'admin' && $p == 'admin') $authentic = true;
            return $authentic;
        }
        
        function logout(){
            //esegue il logout
            session_start();
            session_destroy();
        }
    }
?>

