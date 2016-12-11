<h5>Notificação: <?=$n->ID_NOTIF?></h5><?=$n->data?>
<h5>Informações do paciente:</h5>
<table class="table table-sm">
	<thead>
	  <tr>
		<th>Raça</th>
		<th>Escolaridade</th>
		<th>Ocupação</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td><?=$n->RACA?></td>
		<td><?=$n->ESCOLARIDADE?></td>
		<td><?=$n->OCUPACAO?></td>
	  </tr>
	</tbody>
</table>
<h5>Procedimentos realizados:</h5>
<table class="table table-sm">
	<thead>
	  <tr>
		<?php
		if(!empty($procedimentos)){
			echo "<th>Procedimento</th>
		<th>Resultado</th>";
		}else{
			echo "Nenhum procedimento realizado";
		}
		?>
		
	  </tr>
	</thead>
	<tbody>
	  <?php
	  	foreach($procedimentos as $p){
			$proc = $p['PROCEDIMENTO'];
			$resu = $p['RESULTADO'];
			echo "<tr>";
			echo "<td>$proc</td>";
			echo "<td>$resu</td>";
			echo "</tr>";
		}
	  ?>
	</tbody>
</table>

<h5>Unidade de tratamento:</h5> 
<?php 
	if($n->UNIDADE != NULL){
		echo $n->UNIDADE;
	}else{
		echo "Sem informações";
	}
?>