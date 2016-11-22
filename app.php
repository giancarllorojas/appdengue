<?php
/**
 *
 */

class App {
    /**
     * Classe principal do aplicativo para ficar SINGLETON
     */
    private $con = null;

    function __construct($config){
        $this->conecta($config);
    }

    public static function pega_instancia(){
        static $instance = null;
        if(null === $instance){
            $instance = new static();
        }
        return $instance;
    }

    public function conecta($config){
        if($this->con == null){
            $this->con = new PDO("mysql:host=".$config['host']."dbname=".$config['database']."\"", $config['usuario'], $config['senha']);
        }
    }
}