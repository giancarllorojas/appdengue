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
            $this->con = new PDO($str_con, $config['usuario'], $config['senha'],
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$this->con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        }
    }
	
	public function pega_notificacoes($ano, $mes){
		$sql = "SELECT ID_NOTIF, LONGITUDE, LATITUDE FROM m_notificacao WHERE YEAR(DATA) = $ano";
		if($mes != -1){
			$sql .= " and MONTH(DATA) = $mes";
		}
		return $this->con->query($sql);
	}
	public function pega_notificacao($id_notif){
		$sql = "-- PEGA INFORMAÇÕES SOBRE O GRUPO DE UMA NOTIFICAO($id_notif), SUA UNIDADE DE TRATAMENTO E A DATA DA NOTIFICAO
		SELECT t.ID_NOTIF, t.DATA, t.ESCOLARIDADE, t. RACA, t. OCUPACAO, u.RAZAOSOCIAL as UNIDADE from(
		SELECT n.DATA, n.ID_UNIDADE, n.ID_NOTIF, e.DESCRICAO as ESCOLARIDADE, r.DESCRICAO as RACA, o.DESCRICAO as OCUPACAO FROM m_notificacao n
		LEFT JOIN m_grupo g ON g.ID_GRUPO = n.ID_GRUPO
    	LEFT JOIN m_grupo_escolaridade e ON e.ID_ESCOL=g.ID_ESCOL
    	LEFT JOIN m_grupo_raca r ON r.ID_RACA = g.ID_RACA
    	LEFT JOIN m_grupo_ocupacao o ON o.ID_OCUPA = g.ID_OCUPA
		) t 
		LEFT JOIN m_unidade u ON t.ID_UNIDADE = u.ID_UNIDADE
		WHERE t.ID_NOTIF = $id_notif";
		return $this->con->query($sql)->fetchObject();
	}
	
	public function pega_procedimentos($id_notif){
		$sql = "SELECT n.ID_NOTIF, p.DESCRICAO as PROCEDIMENTO, pr.DESCRICAO as RESULTADO from m_notificacao n
				JOIN m_notificacao_procedimentos np ON np.ID_NOTIF=n.ID_NOTIF AND n.ID_NOTIF=$id_notif
				JOIN m_procedimento p ON p.ID_PROCED=np.ID_PROCED
				JOIN m_procedimento_resultado pr ON pr.ID_PROCED=p.ID_PROCED AND pr.RESULT_N=np.RESULT_N";
		return $this->con->query($sql)->fetchAll();
	}
	
	public function not_por_grupo(){
		$sql = "SELECT COUNT(*) as QUANTIDADE, ESCOLARIDADE, RACA, OCUPACAO FROM (
		SELECT g.ID_GRUPO, e.DESCRICAO as ESCOLARIDADE, r.DESCRICAO as RACA, o.DESCRICAO as OCUPACAO FROM m_notificacao n
		LEFT JOIN m_grupo g ON g.ID_GRUPO = n.ID_GRUPO
    	LEFT JOIN m_grupo_escolaridade e ON e.ID_ESCOL=g.ID_ESCOL
    	LEFT JOIN m_grupo_raca r ON r.ID_RACA = g.ID_RACA
    	LEFT JOIN m_grupo_ocupacao o ON o.ID_OCUPA = g.ID_OCUPA
		) t GROUP BY t.ID_GRUPO ORDER BY QUANTIDADE DESC";
		return $this->con->query($sql)->fetchAll();
	}
	
	public function casos_por_ano(){
		$sql = "SELECT YEAR(DATA) AS ANO, COUNT(*) CASOS FROM m_notificacao GROUP BY ANO";
		return $this->con->query($sql)->fetchAll();
	}
	
	public function casos_por_tipo(){
		$sql = "SELECT t.QUANTIDADE, pr.DESCRICAO as TIPO FROM (SELECT ID_PROCED, RESULT_N, COUNT(*) AS QUANTIDADE 
FROM m_notificacao_procedimentos WHERE ID_PROCED=4 GROUP BY RESULT_N) t 
JOIN m_procedimento_resultado pr ON pr.ID_PROCED=t.ID_PROCED AND pr.RESULT_N=t.RESULT_N ORDER BY t.QUANTIDADE DESC";
		return $this->con->query($sql)->fetchAll();
	}
	
	public function casos_por_grupo(){
		$sql = "SELECT COUNT(*) as QUANTIDADE, ESCOLARIDADE, RACA, OCUPACAO FROM (
    SELECT g.ID_GRUPO, e.DESCRICAO as ESCOLARIDADE, r.DESCRICAO as RACA, g.ID_OCUPA as OCUPACAO FROM m_notificacao n
		LEFT JOIN m_grupo g ON g.ID_GRUPO = n.ID_GRUPO
    	LEFT JOIN m_grupo_escolaridade e ON e.ID_ESCOL=g.ID_ESCOL
    	LEFT JOIN m_grupo_raca r ON r.ID_RACA = g.ID_RACA
    	LEFT JOIN m_grupo_ocupacao o ON o.ID_OCUPA = g.ID_OCUPA
) t GROUP BY t.ID_GRUPO ORDER BY QUANTIDADE DESC LIMIT 10";
		return $this->con->query($sql)->fetchAll();
	}
	
	public function casos_por_mes_por(){
		$sql = "SELECT * FROM porcentagem_mes";
		return $this->con->query($sql)->fetchAll();
	}
}