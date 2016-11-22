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
        <div class="menu_titulo"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> OPÇÕES <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" style="float:right"></span> </div>
    </div>
    <div id="map"></div>

    <script src="<?=$config['base_url']?>/javascript/jquery-3.1.1.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/bootstrap.min.js"></script>
    <script src="<?=$config['base_url']?>/javascript/mapa_estilo.js"></script>
    <script src="<?=$config['base_url']?>/javascript/mapa.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=$config['gmaps_key']?>&callback=inicializa&language=pt-br" async defer></script>
</body>
</html>