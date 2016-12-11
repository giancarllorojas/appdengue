<html>
<head>
    <title>Informações</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?=$config['base_url']?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$config['base_url']?>/css/info.css">
</head>
<body>
<h1>Análise das notificações de dengue no Rio de Janeiro</h1>
<span>Simples análise feita para a disciplina de Banco de Dados I da Universidade Federal do Rio de Janeiro. Os dados utilizados foram disponibilizados pela DATARIO, você pode acessa-los clicando <a href="http://data.rio/dataset/casos_notificados_de_dengue" target="_blank">aqui</a>. Tivemos <b>224976</b> de dengue notificados entre <b>Janeiro</b> de <b>2010</b> e <b>Janeiro</b> de <b>2014</b>.
</span>
<br><br><h4>Notificações por ano:</h4> 
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Notificações</th>
<th class="text-left">Casos</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
	foreach($casos_ano as $casos){
		$ano = $casos['ANO'];
		$casos = $casos['CASOS'];
		echo "<tr>";
		echo "<td class=\"text-left\">$ano</td>";
		echo "<td class=\"text-left\">$casos</td>";
		echo "</tr>";
	}
?>
</tbody>
</table>

<br><br><h4>Notificações por tipo de dengue</h4>(dentre os casos com tipo definido) 
<table class="table-fill">
<thead>
<tr>
<th class="text-left"></th>
<th class="text-left">Casos</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
	foreach($casos_tipo as $casos){
		$ano = $casos['TIPO'];
		$casos = $casos['QUANTIDADE'];
		echo "<tr>";
		echo "<td class=\"text-left\">$ano</td>";
		echo "<td class=\"text-left\">$casos</td>";
		echo "</tr>";
	}
?>
</tbody>
</table>

<br><br><h4>Notificações por grupo de indivíduos</h4>(Os 10 mais)
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Escolaridade</th>
<th class="text-left">Raça</th>
<th class="text-left">Ocupação</th>
<th class="text-left">Casos</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
	foreach($casos_grupo as $casos){
		$escol = $casos['ESCOLARIDADE'];
		$raca = $casos['RACA'];
		$ocupa = $casos['OCUPACAO'];
		$casos = $casos['QUANTIDADE'];
		echo "<tr>";
		echo "<td class=\"text-left\">$escol</td>";
		echo "<td class=\"text-left\">$raca</td>";
		echo "<td class=\"text-left\">$ocupa</td>";
		echo "<td class=\"text-left\">$casos</td>";
		echo "</tr>";
	}
?>
</tbody>
</table>

<br><br><h4>Porcentagem de casos por mês</h4>(relativo ao ano) 
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Ano</th>
<th class="text-left">Mês</th>
<th class="text-left">Porcentagem</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
	$meses = array(1 => "Janeiro", 2 => "Fevereiro", 3=> "Março", 4=> "Abril", 5=> "Maio", 6=> "Junho", 7=> "Julho", 8=> "Agosto", 9=> "Setembro", 10=> "Outubro", 11=> "Novembro", 12=> "Dezembro");
	foreach($casos_mes_por as $casos){
		$mes = $meses[$casos['MES']];
		$por = $casos['PORCENTAGEM'];
		$casos = $casos['ANO'];
		echo "<tr>";
		echo "<td class=\"text-left\">$casos</td>";
		echo "<td class=\"text-left\">$mes</td>";
		echo "<td class=\"text-left\">$por</td>";
		echo "</tr>";
	}
?>
</tbody>
</table>
	<script src="<?=$config['base_url']?>/javascript/jquery-3.1.1.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/bootstrap.min.js"></script>
</body>
</html>