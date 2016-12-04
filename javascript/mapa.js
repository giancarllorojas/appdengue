

var map;
var markers = [];
var markerCluster;
function inicializa() {
    var estilo = new google.maps.StyledMapType(estilo_json);
    this.map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -22.94242, lng: -43.14486},
        scrollwheel: true,
        zoom: 9,
        mapTypeControl: false
    });

    this.map.mapTypes.set('estilo', estilo);
    this.map.setMapTypeId('estilo');
	$("#adicionar").click(function(){
		ano = $('#ano').val();
		mes = $('#mes').val();
		pega_dados(ano, mes);
	});
	$("#go").click(function(){
		ano = $('#ano').val();
		mes = $('#mes').val();
		pega_dados(ano, mes);
	});
	pega_dados(2012, 01);
}

function pega_dados(ano, mes){
	console.log('hellow');
	var ano, mes;
	$.ajax({
		url: '/appdengue/?p=notificacoes',
		method: 'GET',
		data: {'ano': ano, 'mes': mes},
		dataType: "json",
		success: function(data) {
			limpa_marcadores();
			for(var i = 0; i < data.length; i++){
				coloca_marcador(data[i]);
			}
			console.log(markers);
			markerCluster = new MarkerClusterer(map, markers, {
            	magePath: 'dengueapp/images'
			});
			//console.log(data);
		},
		error: function(ts) { 
			console.log(ts.responseText);
		}
	});
}

function coloca_marcador(linha){
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(parseFloat(linha[2]), parseFloat(linha[1]))
	});
	marker.addListener('click', function() {
		console.log(linha);
	});
	markers.push(marker);
	
	//console.log('m')
};

function limpa_marcadores(remover) {
	if(markerCluster != null){
		console.log('hello');
		markerCluster.setMap(null);
		markers = [];
	}
}
