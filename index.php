<?php
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
				echo json_encode($a->pega_notificacao($_GET['id']));
			}
			break;
	}
}else{
	include("templates/base.php");
}