

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
        center: {lat: -22.95131191, lng: -43.24877932},
        scrollwheel: true,
        zoom: 10,
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
	$("#prox").click(function(){
		var ano, mes, n_ano, n_mes;
		ano = parseInt($("#ano").val());
		mes = parseInt($("#mes").val());
		n_mes = mes + 1;
		n_ano = ano;
		if(n_mes > 12){
			if(ano <2014){
				n_mes = 1;
				n_ano = ano+1;
			}else{
				n_mes = 1;
				n_ano = 2010;
			}
		}
		if(n_mes <10){
			n_mes = "0" + n_mes;
		}
		$("#ano").val(n_ano);
		$("#mes").val(n_mes);
	})
	$("#ant").click(function(){
		var ano, mes, n_ano, n_mes;
		ano = parseInt($("#ano").val());
		mes = parseInt($("#mes").val());
		n_mes = mes - 1;
		n_ano = ano;
		if(n_mes < 1){
			if(ano > 2010){
				n_mes = 12;
				n_ano = ano-1;
			}else{
				n_mes = 12;
				n_ano = 2014;
			}
		}
		if(n_mes <10){
			n_mes = "0" + n_mes;
		}
		console.log(n_ano);
		$("#ano").val(n_ano);
		$("#mes").val(n_mes);
	})
	pega_dados(2012, 01, 'notificacoes');
}

function pega_dados(ano, mes, tipo){
	//console.log('hellow');
	var ano, mes, url;
	//$("#go").button('loading');
	$.ajax({
		url: '/appdengue/?p=' + tipo,
		method: 'GET',
		data: {'ano': ano, 'mes': mes},
		dataType: "json",
		success: function(data) {
			markers = [];
			
			for(var i = 0; i < data.length; i++){
				coloca_marcador(data[i], tipo);
			}
			console.log(markers);
			limpa_marcadores();
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
	}
}
