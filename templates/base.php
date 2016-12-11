<html>
<head>
    <title>DENGUE RIO</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?=$config['base_url']?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=$config['base_url']?>/css/mapa.css">
</head>
<body>
    <div id="menu">
        <div class="menu_titulo"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> NAVEGAÇÃO <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" style="float:right"></span> </div>
		<div class="form-group">
		  <label for="sel1">Ano:</label>
		  <select class="form-control input-sm" id="ano">
			<option>2010</option>
			<option>2011</option>
			<option selected>2012</option>
			<option>2013</option>
			<option>2014</option>
		  </select>
		  <label for="sel1">Mês:</label>
		  <select class="form-control input-sm" id="mes">
			<option>01</option>
			<option>02</option>
			<option>03</option>
			<option>04</option>
			<option>05</option>
			<option>06</option>
			<option>07</option>
			<option>08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
		  </select>
		  
		</div>
		
		<div id="botoes">
			<button type="button" id="ant" class="btn btn-primary"><<</button>
			<button type="button" id="go" class="btn btn-primary">Visualizar</button>
			<button type="button" id="prox" class="btn btn-primary">>></button>
		</div>
		<a href="<?=$config['base_url']?>?p=info" target="_blank"><button type="button" id="mais" class="btn btn-primary">Mais informações</button></a>
    </div>
    <div id="map"></div>

<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/jquery-3.1.1.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/bootstrap.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/mapa_estilo.js"></script>
    <script src="<?=$config['base_url']?>/javascript/mapa.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=$config['gmaps_key']?>&callback=inicializa&language=pt-br" async defer></script>
	<script src="<?=$config['base_url']?>/javascript/markerclusterer.js"></script>
</body>
</html>