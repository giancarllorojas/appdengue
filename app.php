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

    public function conecta($config){
        if($this->con == null){
			$str_con = "mysql:host=".$config['host'].";dbname=".$config['database'];
			//echo $str_con;
            $this->con = new PDO($str_con, $config['usuario'], $config['senha']);
			$this->con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        }
    }
	
	public function pega_notificacoes($ano, $mes){
		$sql = "SELECT ID_NOTIF, Long_WGS84, Lat_WGS84 FROM m_notificacao WHERE YEAR(DT_NOTIFIC) = $ano";
		if($mes != -1){
			$sql .= " and MONTH(DT_NOTIFIC) = $mes";
		}
		return $this->con->query($sql);
	}
	public function pega_notificacao($id){
		return $this->con->query("SELECT * FROM m_notificacao where ID_NOTIF = $id")->fetch();
	}
}