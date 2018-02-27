<?php

class Conn {

    public static $host;
    public static $db;
    public static $user;
    public static $pass;
    public static $instance;
    
    
    public static function Conect() {
        
        
        self::$host = 'localhost';
        self::$db = 'agenda';
        self::$user = 'root';
        self::$pass = '';
        
        try {
            self::$instance = new PDO('mysql:host='.self::$host.';dbname='.self::$db, self::$user, self::$pass);
            self::$instance-> exec("SET CHARACTER SET utf8");
            return self::$instance;
        } catch (Exception $e) {
            $html = '<div class="alert alert-danger text-center">Não foi possível acessar o Banco de Dados! <br>';
            $html.= 'Favor atualize o navegador.';
            $html.= '<br> <b>Se o problema persistir, comunique o administrador</b>';
            $html.= '</div>';
            
            exit($html);
        }
    }

}
