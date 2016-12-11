<?php
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');
require('config.php');
require('app.php');

$a = new App($banco);

if(isset($_GET['p'])){
	$p = $_GET['p'];
	switch($p){
		case 'notificacoes':
			if(isset($_GET['ano'], $_GET['mes'])){
				$ano = $_GET['ano'];
				$mes = $_GET['mes'];
				$not = $a->pega_notificacoes($ano, $mes);
				$rows = array();
				while($linha = $not->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){
					$rows[] = $linha;
				}
				echo json_encode($rows);
			}else if(isset($_GET['ano'])){
				$ano = $_GET['ano'];
				$not = $a->pega_notificacoes($ano, -1);
				$rows = array();
				while($linha = $not->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)){
					$rows[] = $linha;
				}
				echo json_encode($rows);
			}
			break;
		case 'notificacao':
			if(isset($_GET['id'])){
				$n = $a->pega_notificacao($_GET['id']);
				$procedimentos = $a->pega_procedimentos($_GET['id']);
				$date = DateTime::createFromFormat('Y-m-d H:i:s', $n->DATA);
				$n->data = $date->format('\N\o\t\i\f\i\c\a\d\o \\n\o \d\i\a d \d\e M \d\e Y \à\s H:i');
				include("templates/notificacao.php");
			}
			break;
		case 'info':
			$casos_ano = $a->casos_por_ano();
			$casos_tipo = $a->casos_por_tipo();
			$casos_grupo = $a->casos_por_grupo();
			$casos_mes_por = $a->casos_por_mes_por();
			include("templates/info.php");
			break;
	}
}else{
	include("templates/base.php");
}