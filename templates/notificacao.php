<h5>Notificação: <?=$n->ID_NOTIF?></h5><?=$n->data?>
<h5>Informações do paciente:</h5>
<table class="table table-sm">
	<thead>
	  <tr>
		<th>Ocupação</th>
		<th>Raça</th>
		<th>Escolaridade</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td><?=$n->ID_OCUPA_N?></td>
		<td><?=$n->CS_RACA?></td>
		<td><?=$n->CS_ESCOL_N?></td>
	  </tr>
	</tbody>
</table>
<h5>Procedimentos realizados:</h5>
<table class="table table-sm">
	<thead>
	  <tr>
		<th>SORO</th>
		<th>VIRAL</th>
		<th>PCR</th>
		<th>HISTOPA_N</th>
		<th>IMUNOH_N</th>
		<th>PLAQ_MENOR</th>
		<th>SOROTIPO</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td><?=$n->RESUL_SORO?></td>
		<td><?=$n->RESUL_VI_N?></td>
		<td><?=$n->RESUL_PCR_?></td>
		<td><?=$n->HISTOPA_N?></td>
		<td><?=$n->IMUNOH_N?></td>
		<td><?=$n->PLAQ_MENOR?></td>
		<td><?=$n->SOROTIPO?></td>
	  </tr>
	</tbody>
</table>

<h5>Unidade de tratamento:</h5> 
<?php 
	if($n->ID_UNIDADE != NULL){
		echo $n->ID_UNIDADE;
	}else{
		echo "Sem informações";
	}
?>