

var map;
var markers = [];
var markerCluster;
var infowindow;
var icons;

function inicializa() {
    var estilo = new google.maps.StyledMapType(estilo_json);
	icons = {
	  notificacoes: {
		icon: '/appdengue/images/ico_d.png'
	  },
	  unidades: {
		icon: '/appdengue/images/ico_u.png'
	  },
	};
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
		pega_dados(ano, mes, 'notificacoes');
	});
	$("#unis").click(function(){
		pega_dados(0, 0, 'unidades');
	});
	pega_dados(2012, 01, 'notificacoes');
}

function pega_dados(ano, mes, tipo){
	//console.log('hellow');
	var ano, mes, url;
	$.ajax({
		url: '/appdengue/?p=' + tipo,
		method: 'GET',
		data: {'ano': ano, 'mes': mes},
		dataType: "json",
		success: function(data) {
			limpa_marcadores();
			for(var i = 0; i < data.length; i++){
				coloca_marcador(data[i], tipo);
			}
			console.log(markers);
			markerCluster = new MarkerClusterer(map, markers, {
            	imagePath: '/appdengue/images/'
			});
			//console.log(data);
		},
		error: function(ts) { 
			console.log(ts.responseText);
		}
	});
}

function abre_marcador(marker, id, tipo){
	if(tipo == 'notificacoes'){
		tipo = 'notificacao';
	}
	if(tipo == 'unidades'){
		tipo = 'unidade';
	}
	$.ajax({
		url: '/appdengue/?p=notificacao',
		method: 'GET',
		data: {'id': id},
		success: function(data){
			if(infowindow != null){
				infowindow.close();
			}
			infowindow = new google.maps.InfoWindow({
				content: data
			});
			infowindow.open(map, marker);
			//console.log(data);
		}
	});
}

function coloca_marcador(linha, tipo){
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(parseFloat(linha[2]), parseFloat(linha[1])),
		icon: icons[tipo].icon
	});
	marker.addListener('click', function() {
		abre_marcador(marker, parseInt(linha[0]));
	});
	markers.push(marker);
};

function limpa_marcadores(remover) {
	if(markerCluster != null){
		console.log('hello');
		markerCluster.setMap(null);
		markers = [];
	}
}
