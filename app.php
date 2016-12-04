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
		$sql = "SELECT n.ID_NOTIF , n.DT_NOTIFIC, g.ID_OCUPA_N, g.CS_RACA, g.CS_ESCOL_N, p.RESUL_SORO, p.RESUL_VI_N, p.RESUL_PCR_, p.HISTOPA_N, p.IMUNOH_N, p.PLAQ_MENOR, p.SOROTIPO, u.ID_UNIDADE, u.RAZAOSOCIAL, u.TIPODEESTABELECIMENTO as EST_TIPO 
	from m_notificacao n 
	left join m_procedimentos p
	on n.ID_NOTIF = p.ID_NOTIF
	left join m_grupo g
	on n.ID_GRUPO = g.ID_GRUPO
	left join m_unidade u
	on n.ID_UNIDADE = u.ID_UNIDADE
	where n.ID_NOTIF = $id";
		return $this->con->query($sql)->fetchObject();
	}
	
	public function pega_unidades(){
		$sql = "SELECT * FROM m_unidade";
		return $this->con->query($sql);
	}
}