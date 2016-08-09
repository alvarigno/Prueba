<?php
//Change for Chilemedia Interface
//Modificado por: Álvaro Emparán

	header("Content-type: text/javascript;");
	error_reporting(E_ERROR | E_PARSE);
	// error_reporting(E_ALL);
	set_time_limit(3600);
	
	require_once 'GoogleAnalyticsCLA.php';
	$ga = new GoogleAnalyticsCLA();

	//$diaa = time()-(1*24*60*60);
	$diaa = time();
	$d= date('d', $diaa);
	$m= date('m', $diaa);
	$a= date('Y', $diaa);

	// periodo tiempo
	if (isset($_GET["mes"]) && isset($_GET["anio"])) {
		$fechaIni  = date('Y-m-d', mktime(0, 0, 0, $_GET["mes"], 1, $a));
		$fechaIni2  = date('d/m/Y', mktime(0, 0, 0, $_GET["mes"], 1, $a));
		$maxDia = cal_days_in_month(CAL_GREGORIAN, date('m', mktime(0, 0, 0, $_GET["mes"], 1, $a)), $a);
		$fechaFin = date('Y-m-d', mktime(0, 0, 0, $_GET["mes"], $maxDia, $a));
		$fechaFin2 = date('d/m/Y', mktime(0, 0, 0, $_GET["mes"], $maxDia, $a));
	} else {
		$fechaIni  = date('Y-m-d', mktime(0, 0, 0, $m-1, 1, $a));
		$fechaIni2  = date('d/m/Y', mktime(0, 0, 0, $m-1, 1, $a));
		$maxDia = cal_days_in_month(CAL_GREGORIAN, date('m', mktime(0, 0, 0, $m-1, 1, $a)), $a);
		$fechaFin = date('Y-m-d', mktime(0, 0, 0, $m-1, $maxDia, $a));
		$fechaFin2 = date('d/m/Y', mktime(0, 0, 0, $m-1, $maxDia, $a));
	}

	//echo $fechaIni . " " . $fechaFin . date('d/m/Y', $diaa) . "<br>";
	$mesAnterior = date('m', mktime(0, 0, 0, $m-1, 1, $a));
	$strKeyFecha = $fechaIni.'~'.$fechaFin;


	/**************************
	* MES
	**************************/
	$ga->setDateRange($fechaIni, $fechaFin);

	// visitas totales
	$totalesM = $ga->getResults(array(
			'dimensions'=>'ga:year,ga:month,ga:day',
			'metrics'=>'ga:visits,ga:visitors,ga:pageViews',
			'sort'=>'ga:year,ga:month,ga:day'
		)
	);

	// visitas unicas
	$unicosM = $ga->getResults(array(
			'dimensions'=>'',
			'metrics'=>'ga:pageViews,ga:visits,ga:visitors,ga:avgTimeOnSite'
		)
	);

	// valores del mes
	$datosM = array(visits=>array(), pageViews=>array());
	foreach ($totalesM as $date => $value) {
		array_push($datosM['visits'], array(date=>''.str_replace('~', '/', $date).'', total=>intval($value['ga:visits'])));
		array_push($datosM['pageViews'], array(date=>''.str_replace('~', '/', $date).'', total=>intval($value['ga:pageViews'])));
		//echo $date . ": " . $value['ga:visitors'] . "<br>";
	}

	$totVisitsM      = $unicosM[$strKeyFecha]['ga:visits'];        // total visitas
	$pageViewsM      = $unicosM[$strKeyFecha]['ga:pageViews'];     // total paginas vistas
	$uniqueVisitorsM = $unicosM[$strKeyFecha]['ga:visitors'];      // visitantes unicos
	$avgTimeM        = $unicosM[$strKeyFecha]['ga:avgTimeOnSite'];      // tiempo promedio de la visita

	$totalViewsMes     = $pageViewsM;
	$totalSessionesMes = $totVisitsM;
	$depthVM           = number_format($pageViewsM / $totVisitsM, 2, ',', '.');
	$totVisitsM        = number_format($totVisitsM, 0, ',', '.');
	$pageViewsM        = number_format($pageViewsM, 0, ',', '.');
	$uniqueVisitorsM   = number_format($uniqueVisitorsM, 0, ',', '.');
	$avgTimeM          = number_format($avgTimeM / 60, 2, ',', '.');

	// dispositivos
	$dispositivosGA = $ga->getResults(array(
			'dimensions'=>'ga:month,ga:deviceCategory',
			'metrics'=>'ga:sessions'
		)
	);

	$totalDesktop = (Integer)$dispositivosGA[$mesAnterior."~desktop"]["ga:sessions"];
	$totalMobile  = (Integer)$dispositivosGA[$mesAnterior."~mobile"]["ga:sessions"];
	$totalTablet  = (Integer)$dispositivosGA[$mesAnterior."~tablet"]["ga:sessions"];
	$totalMoviles = $totalMobile + $totalTablet;

	$dispositivos = (Object) array(
		"totalDesktop"=>number_format($totalDesktop, 0, ',', '.'),
	   	"totalMobile"=>number_format($totalMobile, 0, ',', '.'),
	    "totalTablet"=>number_format($totalTablet, 0, ',', '.'),
		"porcentajeDesktop"=>number_format( ($totalDesktop*100)/$totalSessionesMes, 2, ',', '.' ),
	   	"porcentajeMobile"=>number_format( ($totalMobile*100)/$totalSessionesMes, 2, ',', '.' ),
	    "porcentajeTablet"=>number_format( ($totalTablet*100)/$totalSessionesMes, 2, ',', '.' )
	);

	// OS móviles
	$osMovilesGA = $ga->getResults(array(
		'metrics'=>'ga:sessions',
		'dimensions'=>'ga:operatingSystem',
		'filters'=>'ga:operatingSystem=~(android|ios|windows phone);ga:deviceCategory!=desktop'));

	$totalAndroid = (Integer)$osMovilesGA["Android"]["ga:sessions"];
	$totalIOS     = (Integer)$osMovilesGA["iOS"]["ga:sessions"];
	$totalWP      = (Integer)$osMovilesGA["Windows Phone"]["ga:sessions"];
	$totalOtrosOS = $totalMoviles - ($totalAndroid + $totalIOS + $totalWP);

	$osMoviles = (Object) array(
		"android" => number_format( ($totalAndroid*100)/$totalMoviles, 2, ',', '.' ),
		"ios" => number_format( ($totalIOS*100)/$totalMoviles, 2, ',', '.' ),
		"windowsPhone" => number_format( ($totalWP*100)/$totalMoviles, 2, ',', '.' ),
		"otros" => number_format( ($totalOtrosOS*100)/$totalMoviles, 2, ',', '.' ),
	);

	// navegadores
	$navegadoresGA = $ga->getResults(array(
			'metrics'=>'ga:pageViews',
			'dimensions'=>'ga:month,ga:browser',
			'filters'=>'ga:browser==Chrome,ga:browser==Firefox,ga:browser==Safari,ga:browser==Opera,ga:browser=~(internet explorer|IE)'
		)
	);

	$totalChrome  = (Float)$navegadoresGA[$mesAnterior."~Chrome"]["ga:pageViews"];
	$totalFirefox = (Float)$navegadoresGA[$mesAnterior."~Firefox"]["ga:pageViews"];
	$totalOpera   = (Float)$navegadoresGA[$mesAnterior."~Opera"]["ga:pageViews"];
	$totalSafari  = (Float)$navegadoresGA[$mesAnterior."~Safari"]["ga:pageViews"];
	$totalIE      = (Float)$navegadoresGA[$mesAnterior."~IE with Chrome Frame"]["ga:pageViews"] + (Float)$navegadoresGA[$mesAnterior."~Internet Explorer"]["ga:pageViews"] + (Float)$navegadoresGA[$mesAnterior."~Internet explorer"]["ga:pageViews"];

	$aNavegadores = array(
		array(($totalChrome*100)/$totalViewsMes, "Google Chrome"),
		array(($totalFirefox*100)/$totalViewsMes, "Firefox"),
		array(($totalOpera*100)/$totalViewsMes, "Opera"),
		array(($totalSafari*100)/$totalViewsMes, "Safari"),
		array(($totalIE*100)/$totalViewsMes, "IE"),
	);

	rsort($aNavegadores);
	$navegadores = "[";

	for ($x = 0, $len = count($aNavegadores); $x < $len; $x++) {
		//$navegadores[$aNavegadores[$x][1]] = number_format($aNavegadores[$x][0], 2, ',', '.');
		//echo $aNavegadores[$x][1] . "<br>";

		//array_push($navegadores, array($aNavegadores[$x][1], number_format($aNavegadores[$x][0], 2, ',', '.')));
		$navegadores .= '["' . $aNavegadores[$x][1] . '", "' . number_format($aNavegadores[$x][0], 2, ',', '.') . '"],';
    console.log('["' . $aNavegadores[$x][1] . '", "' . number_format($aNavegadores[$x][0], 2, ',', '.') . '"],');
	}

	$navegadores = preg_replace("/,$/", "", $navegadores) . "]";

	// arreglo con los filtros para desktop y movil
	$filters = array(
		'Desktop'=>array(
			'Home'=>'ga:deviceCategory==desktop && ga:pagePath=~(\/portada*|\/chileautos*)',
			'Busquedas'=>'ga:deviceCategory==desktop && ga:pagePath=~(\/cemagic*)',
			'Auto'=>'ga:deviceCategory==desktop && ga:pagePath=~(\/auto*)',
			'Otras'=>'ga:deviceCategory==desktop && ga:pagePath!~(\/portada*|\/chileautos*|\/auto*|\/cemagic*)'
		),
		'Movil'=>array(
			'Home'=>'ga:deviceCategory!=desktop && ga:pagePath=~(\/index*|\/portada*|\/chileautos*)',
			'Busquedas'=>'ga:deviceCategory!=desktop && ga:pagePath=~(\/cemagic*)',
			'Auto'=>'ga:deviceCategory!=desktop && ga:pagePath=~(\/ficha*|\/verfoto*|\/auto*)',
			'Otras'=>'ga:deviceCategory!=desktop && ga:pagePath!~(\/index*|\/cemagic*|\/ficha*|\/verfoto*|\/auto*|\/portada*|\/chileautos*)'
		)
	);

	// páginas desktop
	$home = $ga->getResults(array(
		'metrics'=>'ga:pageViews',
		'filters'=>'ga:pagePath=~(\/index*|\/portada*|\/chileautos*)'));
	$cemagic = $ga->getResults(array(
		'metrics'=>'ga:pageViews',
		'filters'=>'ga:pagePath=~(\/cemagic*)'));
	$auto = $ga->getResults(array(
		'metrics'=>'ga:pageViews',
		'filters'=>'ga:pagePath=~(\/ficha*|\/verfoto*|\/auto*)'));

	$totalPortada = $home[$strKeyFecha]["ga:pageViews"];
	$totalCemagic = $cemagic[$strKeyFecha]["ga:pageViews"];
	$totalAuto    = $auto[$strKeyFecha]["ga:pageViews"];
	$totalOtras   = $totalViewsMes - ($totalPortada + $totalCemagic + $totalAuto);

	$paginasVistas = (Object) array(
		"totalPortada" => number_format( $totalPortada , 0, ',', '.' ),
		"totalCemagic" => number_format( $totalCemagic , 0, ',', '.' ),
		"totalAuto" => number_format( $totalAuto , 0, ',', '.' ),
		"totalOtras" => number_format( $totalOtras , 0, ',', '.' ),
		"total" => number_format( $totalViewsMes , 0, ',', '.' ),
		"porcentajePortada" => number_format( ($totalPortada*100)/$totalViewsMes , 2, ',', '.' ),
		"porcentajeCemagic" => number_format( ($totalCemagic*100)/$totalViewsMes , 2, ',', '.' ),
		"porcentajeAuto" => number_format( ($totalAuto*100)/$totalViewsMes , 2, ',', '.' ),
		"porcentajeOtras" => number_format( ($totalOtras*100)/$totalViewsMes , 2, ',', '.' ),
		"porcentajeTotal" => 100
	);

	// usuarios
	$usuariosGA = $ga->getResults(array(
			'dimensions'=>'ga:month,ga:userType',
			'metrics'=>'ga:sessions'
		)
	);

	$totalVisitasNuevas      = (Integer)$usuariosGA[$mesAnterior."~New Visitor"]["ga:sessions"];
	$totalVisitasRecurrentes = (Integer)$usuariosGA[$mesAnterior."~Returning Visitor"]["ga:sessions"];

	$usuarios = (Object) array(
		"totalVisitasRecurrentes" => number_format( $totalVisitasRecurrentes, 0, ',', '.' ),
		"totalVisitasNuevas" => number_format( $totalVisitasNuevas, 0, ',', '.' ),
		"porcentajeVisitasRecurrentes" => number_format( ($totalVisitasRecurrentes*100)/$totalSessionesMes, 2, ',', '.' ),
		"porcentajeVisitasNuevas" => number_format( ($totalVisitasNuevas*100)/$totalSessionesMes, 2, ',', '.' ),
	);

	// $ga->setDateRange('2014-07-01', '2014-07-31');

	// audiencia
	$audienciaGA = $ga->getResults(array(
			'dimensions'=>'ga:month,ga:userGender',
			'metrics'=>'ga:pageViews'
		)
	);

	$totalHombre = (Integer)$audienciaGA[$mesAnterior.'~male']["ga:pageViews"];
	$totalMujer  = (Integer)$audienciaGA[$mesAnterior.'~female']["ga:pageViews"];
	$totalAudiencia = $totalHombre + $totalMujer;

	$audiencia = (Object) array(
		"porcentajeHombre" => number_format( ($totalHombre*100)/$totalAudiencia , 2, ',', '.' ),
		"porcentajeMujer" => number_format( ($totalMujer*100)/$totalAudiencia , 2, ',', '.' )
	);


	// edad
	$edadGA = $ga->getResults(array(
			'dimensions'=>'ga:month,ga:userAgeBracket',
			'metrics'=>'ga:pageViews'
		)
	);

	$totalMax24 = (Integer)$edadGA[$mesAnterior.'~18-24']["ga:pageViews"];
	$totalMax34 = (Integer)$edadGA[$mesAnterior.'~25-34']["ga:pageViews"];
	$totalMax44 = (Integer)$edadGA[$mesAnterior.'~35-44']["ga:pageViews"];
	$totalMax54 = (Integer)$edadGA[$mesAnterior.'~45-54']["ga:pageViews"];
	$totalMax64 = (Integer)$edadGA[$mesAnterior.'~55-64']["ga:pageViews"];
	$totalMas65 = (Integer)$edadGA[$mesAnterior.'~65+']["ga:pageViews"];
	$totalEdad  = $totalMax24 + $totalMax34 + $totalMax44 + $totalMax54 + $totalMax64 + $totalMas65;

	$edad = (Object) array(
		"porcentajeMax24" => number_format( ($totalMax24*100)/$totalEdad , 2, ',', '.' ),
		"porcentajeMax34" => number_format( ($totalMax34*100)/$totalEdad , 2, ',', '.' ),
		"porcentajeMax44" => number_format( ($totalMax44*100)/$totalEdad , 2, ',', '.' ),
		"porcentajeMax54" => number_format( ($totalMax54*100)/$totalEdad , 2, ',', '.' ),
		"porcentajeMax64" => number_format( ($totalMax64*100)/$totalEdad , 2, ',', '.' ),
		"porcentajeMas65" => number_format( ($totalMas65*100)/$totalEdad , 2, ',', '.' ),
	);

	/**************************
	* AÑO
	**************************/
	$fechaIni    = date('Y-m-d', mktime(0, 0, 0, $m, 1, $a-1));
	$maxDia      = cal_days_in_month(CAL_GREGORIAN, date('m', mktime(0, 0, 0, $m-1, 1, $a)), $a);
	$fechaFin    = date('Y-m-d', mktime(0, 0, 0, $m-1, $maxDia, $a));
	$strKeyFecha = $fechaIni.'~'.$fechaFin;

	$ga->setDateRange($fechaIni, $fechaFin);
	$totalesY = $ga->getResults(
				array(
					'dimensions'=>'ga:year,ga:month',
					'metrics'=>'ga:visits,ga:visitors,ga:pageViews',
					'sort'=>'ga:year,ga:month'
				)
			);

	$unicosY = $ga->getResults(array(
			'dimensions'=>'',
			'metrics'=>'ga:pageViews,ga:visits,ga:visitors,ga:avgTimeOnSite'
		)
	);

	// valores año
	$datosY = array(visits=>array(), pageViews=>array());
	foreach ($totalesY as $date => $value) {
		array_push($datosY['visits'], array(date=>''.str_replace('~', '/', $date . '/01').'', total=>intval($value['ga:visits'])));
		array_push($datosY['pageViews'], array(date=>''.str_replace('~', '/', $date . '/01').'', total=>intval($value['ga:pageViews'])));
		//echo $date . ": " . $value['ga:visitors'] . "<br>";
	}

	$totVisitsY      = $unicosY[$strKeyFecha]['ga:visits'];        // total visitas
	$pageViewsY      = $unicosY[$strKeyFecha]['ga:pageViews'];     // total paginas vistas
	$uniqueVisitorsY = $unicosY[$strKeyFecha]['ga:visitors'];      // visitantes unicos
	$avgTimeY        = $unicosY[$strKeyFecha]['ga:avgTimeOnSite'];      // tiempo promedio de la visita

	$depthVY         = number_format($pageViewsY / $totVisitsY, 2, ',', '.');
	$totVisitsY      = number_format($totVisitsY, 0, ',', '.');
	$pageViewsY      = number_format($pageViewsY, 0, ',', '.');
	$uniqueVisitorsY = number_format($uniqueVisitorsY, 0, ',', '.');
	$avgTimeY        = number_format($avgTimeY / 60, 2, ',', '.');

	$datosM = json_encode($datosM);
	$datosY = json_encode($datosY);


$script = <<<EOT
	google.load("visualization","1",{packages:["corechart"],language:"es"});

	var labels = {
	    visits: 'Visitas',
	    pageView: 'Páginas vistas',
	    visitors: 'Visitantes únicos',
	    avgVisits: 'Páginas / Visitas',
	    avgTime: 'Duración promedio visitas'
	},
	data = {
	    month: '$datosM',
	    year: '$datosY'
	};

	/*google.load('visualization', '1', {
	    packages: [
	        'corechart'
	    ],
	    language: 'es'
	});*/

	//google.setOnLoadCallback(getAreaChart);

	// parsea y devuelve los datos
	function getDatos(idx, data) {
	    var objDatos = data,
	    datos = [
	    ],
	    IE = false
	    ;
	    try {
	        objDatos = JSON.parse(objDatos);
	    } catch (e) {
	        objDatos = eval('[' + objDatos + ']') [0];
	    }
	    //datos = objDatos;

	    if (window.navigator.userAgent.indexOf('IE') > - 1) {
	        IE = true;
	    }
	    for (var i = 0, m = objDatos[idx].length; i < m; i++) {
	        /*if (IE) {
	                    dDate = new Date(objDatos[i].date.replace(/\s+/g, '/'));
	                } else {
	                    dDate = new Date(objDatos[i].date)
	                }*/
	        var dDate = new Date(objDatos[idx][i].date),
	        dVisits = objDatos[idx][i].total
	        ;
	        if (dVisits) {
	            datos.push([dDate,
	            dVisits,
	            dVisits.toString()]);
	        }
	    }
	    return datos;
	}

	/*
	function divTotal(totVisitas, pageView, uniqueV, pageVisit, timeV, element) {
	    this.totV = totVisitas;
	    this.pageView = pageView;
	    this.uniqueV = uniqueV;
	    this.pageVisit = pageVisit;
	    this.timeV = timeV;
	    this.ele = element;
	}

	divTotal.prototype.create = function (op) {
	    var divDatos = document.getElementById(this.ele),
	    visits = document.createElement('div'),
	    pageViews = document.createElement('div'),
	    uniqueVisitors = document.createElement('div'),
	    pageVisit = document.createElement('div'),
	    timeVisit = document.createElement('div')
	    ;
	    visits.innerHTML = '<h3>' + labels.visits + '</h3><span><span class="totales">' + this.totV + '</span>';
	    pageViews.innerHTML = '<h3>' + labels.pageView + '</h3><span class="totales">' + this.pageView + '</span>';
	    uniqueVisitors.innerHTML = '<h3>' + labels.visitors + '</h3><span class="totales">' + this.uniqueV + '</span>';
	    pageVisit.innerHTML = '<h3>' + labels.avgVisits + '</h3><span class="totales">' + this.pageVisit + '</span>';
	    timeVisit.innerHTML = '<h3>' + labels.avgTime + '</h3><span class="totales">' + this.timeV + ' min.</span>';
	    divDatos.appendChild(visits);
	    divDatos.appendChild(pageViews);
	    divDatos.appendChild(uniqueVisitors);
	    if (op && op === true) {
	        divDatos.appendChild(pageVisit);
	        divDatos.appendChild(timeVisit);
	    }
	};
	*/


	// grafico con los totales del año (API google)
	function getAreaChart() {
	    var datos = getDatos('visits', data.year),
	    dataTab = new google.visualization.DataTable(),
	    dateFormat = new google.visualization.DateFormat({
	        pattern: 'MMM yyyy'
	    }),
	    dataView = new google.visualization.DataView(dataTab),
	    chart = new google.visualization.AreaChart(document.getElementById('areachart')),
	    options = {
	        hAxis: {
	            showTextEvery: 2
	        },
	        vAxis: {
	            gridlines: {
	                count: 3
	            },
	            minValue: 0
	        },
	        legend: {
	            position: 'top'
	        },
	        axisTitlesPosition: 'none',
	        isHtml: true,
	        focusTarget: 'category',
	        pointSize: 4,
	        chartArea: {
	            height: '80%',
	            width: '85%'
	        }
	    }
	    ;
	    dataTab.addColumn('date', 'fecha');
	    dataTab.addColumn('number', 'visitas');
	    dataTab.addColumn({
	        type: 'string',
	        role: 'tooltip'
	    });
	    dataTab.addRows(datos);
	    // formatea la fecha
	    dateFormat.format(dataTab, 0);
	    //var dataView = new google.visualization.DataView(dataTab);
	    dataView.setColumns([{
	        calc: function (data, row) {
	            return data.getFormattedValue(row, 0);
	        },
	        type: 'string'
	    },
	    1]);
	    chart.draw(dataView, options);
	}

	function getPieChartUsers () {
		var recurrentes = parseFloat('$usuarios->porcentajeVisitasRecurrentes'.replace(',', '.'));
		var nuevos      = parseFloat('$usuarios->porcentajeVisitasNuevas'.replace(',', '.'));

		var data = google.visualization.arrayToDataTable([
		  ['usuarios', '%'],
		  ['usuarios recurrentes', recurrentes],
		  ['usuarios nuevos', nuevos]
		]);

		var options = {
			title: '',
			slices: {
				0: { color: '#55077F' },
				1: { color: '#E57600' }
        	}
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie-chart-tipos-usuarios'));
		chart.draw(data, options);
	}
  
  

  
	function getPieChartFameleMale () {

    var hombre = ('$audiencia->porcentajeHombre%').replace(',', '.');
    var mujer = ('$audiencia->porcentajeMujer%').replace(',', '.');
    
		var datohombres = parseFloat(hombre);
		var datomujeres = parseFloat(mujer);
    
    console.log(' % totalHombre '+(($totalHombre*100)/$totalAudiencia)+'-');
    console.log('totalHombre '+$totalHombre+'-');
    console.log('totalMujer '+$totalMujer+'-');

    document.getElementById("total-usuarios-hombres").innerHTML = new Intl.NumberFormat("de-DE").format($totalHombre);
    
    document.getElementById("total-usuarios-mujeres").innerHTML = new Intl.NumberFormat("de-DE").format($totalMujer);

    console.log('Total hombres formato: '+ new Intl.NumberFormat("de-DE").format($totalMujer));

    var data = google.visualization.arrayToDataTable([
		  ['usuarios', '%'],
		  ['Hombres', datohombres],
		  ['Mujeres', datomujeres]
		]);

		var options = {
			title: '',
			slices: {
				0: { color: '#8C0D24' },
				1: { color: '#F23869' }
        	}
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie-chart-usuaros-sexo'));
		chart.draw(data, options);
	}
  
  	function getPieChartDevices () {

    var escritorio = ('$dispositivos->porcentajeDesktop%').replace(',', '.');
    var celular = ('$dispositivos->porcentajeMobile%').replace(',', '.');
    var tabla = ('$dispositivos->porcentajeTablet%').replace(',', '.');
    
    console.log('escritorio: '+escritorio);
    console.log('celular: '+celular);
    console.log('tabla: '+tabla);

		var datoescritorio = parseFloat(escritorio);
		var datocelular = parseFloat(celular);
    var datotabla = parseFloat(tabla);

    var data = google.visualization.arrayToDataTable([
		  ['usuarios', '%'],
		  ['Eq. Escritorios', datoescritorio],
		  ['Eq. Celulares', datocelular],
      ['Eq. Tablas', datotabla ]
		]);

		var options = {
			title: '',
			slices: {
				0: { color: '#55077F' },
				1: { color: '#D586FF' },
        2: {color: '#890BCC' }
        	}
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie-chart-devices'));
		chart.draw(data, options);
	}

  	function getPieChartMOS () {

    var googleos = ('$osMoviles->android%').replace(',', '.');
    var appleos = ('$osMoviles->ios%').replace(',', '.');
    var windowsos = ('$osMoviles->windowsPhone%').replace(',', '.');
    var othersos = ('$osMoviles->otros%').replace(',', '.');

		var datogoogleos = parseFloat(googleos);
		var datoappleos = parseFloat(appleos);
    var datowindowsos = parseFloat(windowsos);
    var datoothersos = parseFloat(othersos);
        
    var data = google.visualization.arrayToDataTable([
		  ['usuarios', '%'],
		  ['Android', datogoogleos ],
		  ['iOS', datoappleos ],
      ['WindowsPhone', datowindowsos ],
      ['Otros', datoothersos ]
		]);

		var options = {
			title: '',
			slices: {
				0: { color: '#4DBF26' },
				1: { color: '#BABABA' },
        2: { color: '#4253E5' },
        3: { color: '#C6E4E5'}
        	}
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie-chart-OS'));
		chart.draw(data, options);
	}
  
  	function getPieChartBrowsers () {

    var uno = ($totalChrome*100)/$totalViewsMes;
    var dos = ($totalSafari*100)/$totalViewsMes;
    var tres = ($totalIE*100)/$totalViewsMes;
    var cuatro = ($totalFirefox*100)/$totalViewsMes;
    var cinco = ($totalOpera*100)/$totalViewsMes;
    var seis = ((($totalChrome + $totalSafari + $totalIE + $totalFirefox + $totalOpera - $totalViewsMes)* -1)*100)/$totalViewsMes;
    
    var datouno = parseFloat(uno);
    var datodos = parseFloat(dos);
    var datotres = parseFloat(tres);
    var datocuatro = parseFloat(cuatro);
    var datocinco = parseFloat(cinco);
    var datoseis = parseFloat(seis);
    
    document.getElementById("id-cantidad-chorme").innerHTML = new Intl.NumberFormat("de-DE").format($totalChrome);
    document.getElementById("id-cantidad-safari").innerHTML = new Intl.NumberFormat("de-DE").format($totalSafari);
    document.getElementById("id-cantidad-ie").innerHTML = new Intl.NumberFormat("de-DE").format($totalIE);
    document.getElementById("id-cantidad-firefox").innerHTML = new Intl.NumberFormat("de-DE").format($totalFirefox);
    document.getElementById("id-cantidad-opera").innerHTML = new Intl.NumberFormat("de-DE").format($totalOpera);
    document.getElementById("id-cantidad-otros").innerHTML = new Intl.NumberFormat("de-DE").format((($totalChrome + $totalSafari + $totalIE + $totalFirefox + $totalOpera - $totalViewsMes)* -1));
    
    var data = google.visualization.arrayToDataTable([
		  ['usuarios', '%'],
		  ['Chrome', datouno ],
      ['Safari', datodos ],
      ['IE', datotres ],
      ['Firefox', datocuatro ],
      ['Opera', datocinco ],
      ['Otros', datoseis ]
		]);
    
		var options = {
			title: '',
			slices: {
				0: { color: '#4DBF26' },
        1: { color: '#337F1A' },
        2: { color: '#66FF33' },
        3: { color: '#1A400D' },
        4: { color: '#5CE52E' },
        5: { color: '#C6E4E5' }
        	}
		};

		var chart = new google.visualization.PieChart(document.getElementById('pie-chart-browsers'));
		chart.draw(data, options);
	}


	/*
	function getBarChart() {
	    var datos = getDatos(data.month),
	    dataTab = new google.visualization.DataTable(),
	    dateFormat = new google.visualization.DateFormat({
	        pattern: 'd MMM'
	    }),
	    dataView = new google.visualization.DataView(dataTab),
	    chart = new google.visualization.BarChart(document.getElementById('barchart')),
	    options = {
	        hAxis: {
	            gridlines: {
	                count: 3
	            },
	            minValue: 0
	        },
	        vAxis: {
	            title: 'Fecha'
	        },
	        isHtml: true,
	        chartArea: {
	            height: '90%',
	            width: '70%'
	        },
	        series: [
	            {
	                visibleInLegend: true
	            }
	        ],
	        showCategories: true
	    }
	    ;
	    dataTab.addColumn('date', 'fecha');
	    dataTab.addColumn('number', 'visitas');
	    dataTab.addColumn({
	        type: 'string',
	        role: 'annotation'
	    });
	    dataTab.addRows(datos);
	    // formatea la fecha
	    dateFormat.format(dataTab, 0);
	    //var dataView = new google.visualization.DataView(dataTab);
	    dataView.setColumns([{
	        calc: function (data, row) {
	            return data.getFormattedValue(row, 0);
	        },
	        type: 'string'
	    },
	    1]);
	    chart.draw(dataView, options);
	};
	*/

	// objeto que permite crear los graficos de barra
	var claBarChart = (function () {
	    function createChart(oData, id, objConf) {
	        addCss();
	        objConf = objConf || {};

	        var max                = getMax(oData)
	            , contDatos        = document.getElementById(id)
	            , divData          = document.createElement('datos')
	            , fragment         = document.createDocumentFragment()
	            , contLblBar       = document.createElement('div')
	            , contentLegendBar = document.createElement('div')
	            , boxLegendBar     = document.createElement('div')
	            , lblLegendBar     = document.createElement('label')
	            , fragment2        = document.createDocumentFragment()
	            , styleWidth       = 500
	            , styleColor       = 'yellow'
	            ;

	        if (objConf.width) { styleWidth = objConf.width; }
	        if (objConf.color) { styleColor = objConf.color; }

	        contLblBar.className = 'contLblBar';

	        contentLegendBar.style.height = '20px';
	        boxLegendBar.className = 'boxLegendBar';
	        lblLegendBar.className = 'lblLegendBar';

	        if (objConf.legend) {
	            lblLegendBar.innerHTML = objConf.legend;
	            contentLegendBar.appendChild(boxLegendBar);
	            contentLegendBar.appendChild(lblLegendBar);
	        }

	        if (objConf.title) {
	            contentLegendBar.style.textAlign = 'left';
	            contentLegendBar.style.fontStyle = 'italic';
	            contentLegendBar.style.fontWeight = 'bold';
	            contentLegendBar.innerHTML = objConf.title;
	        }

	        //divData.id = 'datosClaBar';
	        divData.className = 'datosClaBar';
	        //divData.style.float = 'left';
	        divData.style.width = styleWidth;
	        divData.style.borderRight = '1px solid #ccc';

	        for (var i = 0, m = oData.length; i < m; i++) {
	            var div          = document.createElement('div')
	                ,divBar      = document.createElement('div')
	                ,contentBar  = document.createElement('div')
	                ,textBar = document.createElement('span')
	                ,percent     = (oData[i][1] * 100) / max
	                ,lblBar      = document.createElement('div')
	                ;

	            percent = parseInt(percent) + '%';

	            lblBar.className      = 'labelBar';
	            div.className         = 'parentBar';
	            contentBar.className  = 'contentBar';
	            divBar.className      = 'bar';
	            textBar.className = 'lblTextBar';

	            divBar.style.width = percent;
	            divBar.style.backgroundColor = styleColor;


	            textBar.innerHTML = formatNumber(oData[i][1]);
	            lblBar.innerHTML = parseDate(oData[i][0]);

	            contentBar.appendChild(divBar);
	            div.appendChild(contentBar);
	            div.appendChild(textBar);
	            fragment.appendChild(div);
	            fragment2.appendChild(lblBar);
	        }

	        divData.appendChild(fragment);
	        contLblBar.appendChild(fragment2);

	        contDatos.appendChild(contentLegendBar);
	        contDatos.appendChild(contLblBar);
	        contDatos.appendChild(divData);
	    }

	    function getMax(obj) {
	        var max = 0;

	        for (var i = 0, m = obj.length; i < m; i++){
	            if (obj[i][1] > max) { max =  obj[i][1]; }
	        }

	        return max;
	    }

	    function parseDate(n) {
	        switch(n.getMonth()) {
	            case 0: return n.getDate() + ' Ene';
	            case 1: return n.getDate() + ' Feb';
	            case 2: return n.getDate() + ' Mar';
	            case 3: return n.getDate() + ' Abr';
	            case 4: return n.getDate() + ' May';
	            case 5: return n.getDate() + ' Jun';
	            case 6: return n.getDate() + ' Jul';
	            case 7: return n.getDate() + ' Ago';
	            case 8: return n.getDate() + ' Sep';
	            case 9: return n.getDate() + ' Oct';
	            case 10: return n.getDate() + ' Nov';
	            case 11: return n.getDate() + ' Dic';
	        }
	    }

	    // formatear numeros
		function formatNumber(n) {
			var num = n.toString()
				, size = num.length
				, cont = 0
				, nNum = ''
				;

			for (var x = (size-1); x >= 0; x--) {
				cont++;
				nNum = num.charAt(x) + nNum;

				if (cont === 3 && x > 0) {
					nNum = '.' + nNum;
					cont = 0;
				}
			}

			return nNum;
		}

	    function addCss() {
	        var css = '.parentBar{float:left;width:100%}.contentBar{width:80%}.datosClaBar{float:left;}.lblTextBar{float:left;font-weight:bold;margin:4px 0px 0px 5px;}.bar{float:left;height:25px;margin:2px 0;width:0}.labelBar{height:21px;margin:2px 0px;padding:3px 0px;}.contLblBar{float:left;border-right:1px solid black;padding:0 4px}.lblLegendBar{float: left;margin:-1px 0px 0px 5px;font-size:12px;}.boxLegendBar{width: 14px;height: 14px;background-color: #3265c9;float: left;margin-left: 60px;}'
	            style = document.createElement('style')
	            ;

	        style.type = 'text/css';
	        if (style.styleSheet) {
	            style.styleSheet.cssText = css;
	        } else {
	            style.appendChild(document.createTextNode(css));
	        }

	        document.getElementsByTagName('head')[0].appendChild(style);
	    }

	    return {
	        createBarChart : createChart,
	        formatNumber : formatNumber
	    }
	}());

	// grafico de barras para las visitas
	claBarChart.createBarChart(getDatos('visits', data.month), 'barchart', {
	    color: '#058dc7',
	    width: '86%',
	    title: 'visitas'
	});

	// grafico de barras para las páginas vistas
	claBarChart.createBarChart(getDatos('pageViews', data.month), 'barchart2', {
	    color: '#058dc7',
	    width: '86%',
	    title: 'páginas vistas'
	});

	(function (global, undefined) {
	    global.loaded = 'true';
	    var d = document;

	    var totalesVisitas = {
	    	"mes": [
	    		["total-visitas-mes", "$totVisitsM"],
	    		["total-paginas-vistas-mes", "$pageViewsM"],
	    		["total-visitantes-unicos-mes", "$uniqueVisitorsM"],
	    		["total-paginas-visitas-mes", "$depthVM"],
	    		["promedio-tiempo-visita-mes", "$avgTimeM"]
	    	],
	    	"anio": [
	    		["total-visitas-anio", "$totVisitsY"],
	    		["total-paginas-vistas-anio", "$pageViewsY"],
	    		["total-visitantes-unicos-anio", "$uniqueVisitorsY"],
	    		["total-paginas-visitas-anio", "$depthVY"],
	    		["promedio-tiempo-visita-anio", "$avgTimeY min."]
	    	]
	    };

	    var dispositivos = [
	    	["dispositivo-desktop-total", "$dispositivos->totalDesktop"],
	    	["dispositivo-mobile-total", "$dispositivos->totalMobile"],
	    	["dispositivo-tablet-total", "$dispositivos->totalTablet"],
	    	["dispositivo-desktop-porcentaje", "$dispositivos->porcentajeDesktop%"],
	    	["dispositivo-mobile-porcentaje", "$dispositivos->porcentajeMobile%"],
	    	["dispositivo-tablet-porcentaje", "$dispositivos->porcentajeTablet%"],
	    ];

	    var sistemasOperativosMovil = [
	    	["os-android", "$osMoviles->android%"],
	    	["os-ios", "$osMoviles->ios%"],
	    	["os-windows-phone", "$osMoviles->windowsPhone%"],
	    	["os-otros", "$osMoviles->otros%"]
	    ];

	    var navegadores = $navegadores;

	    var paginasVistas = [
	    	["total-visitas-portada", "$paginasVistas->totalPortada"],
	    	["total-visitas-cemagic", "$paginasVistas->totalCemagic"],
	    	["total-visitas-auto", "$paginasVistas->totalAuto"],
	    	["total-visitas-otras", "$paginasVistas->totalOtras"],
	    	["total-visitas", "$paginasVistas->total"],
	    	["porcentaje-visitas-portada", "$paginasVistas->porcentajePortada%"],
	    	["porcentaje-visitas-cemagic", "$paginasVistas->porcentajeCemagic%"],
	    	["porcentaje-visitas-auto", "$paginasVistas->porcentajeAuto%"],
	    	["porcentaje-visitas-otras", "$paginasVistas->porcentajeOtras%"],
	    	["porcentaje-visitas", "$paginasVistas->porcentajeTotal%"]
	    ];

	    var audiencia = [
	    	["porcentaje-hombre", "$audiencia->porcentajeHombre%"],
	    	["porcentaje-mujer", "$audiencia->porcentajeMujer%"]
	    ];

	    var edades = [
	    	["porcentaje-edad-18-24", "$edad->porcentajeMax24%"],
	    	["porcentaje-edad-25-34", "$edad->porcentajeMax34%"],
	    	["porcentaje-edad-35-44", "$edad->porcentajeMax44%"],
	    	["porcentaje-edad-45-54", "$edad->porcentajeMax54%"],
	    	["porcentaje-edad-55-64", "$edad->porcentajeMax64%"],
	    	["porcentaje-edad-mas-65", "$edad->porcentajeMas65%"]
	    ];

	    var tipoUsuarios = [
	    	["total-usuarios-recurrentes", "$usuarios->totalVisitasRecurrentes"],
	    	["total-usuarios-nuevos", "$usuarios->totalVisitasNuevas"],
	    	["porcentaje-usuarios-recurrentes", "$usuarios->porcentajeVisitasRecurrentes%"],
	    	["porcentaje-usuarios-nuevos", "$usuarios->porcentajeVisitasNuevas%"]
	    ];

      var sistemaoperativo = [];
      var listasistemasoperativos = [];

	    // totales mes
	    for (var x = 0, len = totalesVisitas.mes.length; x < len; x++) {
	    	if (d.getElementById(totalesVisitas.mes[x][0])) {
	    		d.getElementById(totalesVisitas.mes[x][0]).innerHTML = totalesVisitas.mes[x][1];
	    	}
	    }

	    // totales año
	    for (var x = 0, len = totalesVisitas.anio.length; x < len; x++) {
	    	if (d.getElementById(totalesVisitas.anio[x][0])) {
	    		d.getElementById(totalesVisitas.anio[x][0]).innerHTML = totalesVisitas.anio[x][1];
	    	}
	    }

	    // dispositivos
	    for (var x = 0, len = dispositivos.length; x < len; x++) {
	    	if (d.getElementById(dispositivos[x][0]))  {
	    		d.getElementById(dispositivos[x][0]).innerHTML = dispositivos[x][1];
	    	}
	    }

	    // navegadores
	    /*for (var x = 0, len = navegadores.length; x < len; x++) {
	    	if (d.getElementById(navegadores[x][0]))  {
	    		var ele = d.getElementById(navegadores[x][0]),
	    			idImg = navegadores[x][0]+'-porcentaje',
	    			porcentaje = parseFloat(navegadores[x][1].replace(',', '.'));

	    		d.getElementById(idImg).style.height = (95 - porcentaje) + '%';
	    		ele.innerHTML = navegadores[x][1];
	    	}
	    }*/

	    var htmlBrowsers = "";
	    for (var x = 0, len = navegadores.length; x < len; x++) {
	    	/*if (d.getElementById(navegadores[x][0]))  {
	    		var ele = d.getElementById(navegadores[x][0]),
	    			idImg = navegadores[x][0]+'-porcentaje',
	    			porcentaje = parseFloat(navegadores[x][1].replace(',', '.'));

	    		d.getElementById(idImg).style.height = (95 - porcentaje) + '%';
	    		ele.innerHTML = navegadores[x][1];
	    	}*/

	    	var porcentaje    = 95 - parseFloat(navegadores[x][1].replace(',', '.'));
	    	var porcentajeStr = navegadores[x][1] + '%';
	    	var titulo        = navegadores[x][0];
	    	var nombreBrowser = navegadores[x][0].replace('Google ', '').toLowerCase();

        
        sistemaoperativo[0] = nombreBrowser;
        sistemaoperativo[1] = porcentajeStr;
        
        
        console.log('hola: '+ sistemaoperativo[0] +' - '+ sistemaoperativo[1] +', posición: '+x);/*Muestra nombre y valores de los Browsers, crear array de largo 4*/
        
        listasistemasoperativos[x] = {nombre: sistemaoperativo[0], porcentaje:sistemaoperativo[1]};
        
        console.log('listasistemasoperativos[x]: '+listasistemasoperativos[x].nombre+' - '+listasistemasoperativos[x].porcentaje);


	    	htmlBrowsers += ['<div class="navegador">hola',
								'<div class="titulo">' + titulo + '</div>',
								'<div class="porcentaje">' + porcentajeStr + '</div>',
								'<div class="wrap-browser">',
									'<div class="browser browser_100 ' + nombreBrowser + '"></div>',
									'<div class="browser browser_0 ' + nombreBrowser + '" style="height:' + porcentaje + '%;"></div>',
								'chao</div>',
							'</div>'].join('');
	    }

	    //d.getElementById('browsers').innerHTML = htmlBrowsers;

	    // paginasVistas
	    for (var x = 0, len = paginasVistas.length; x < len; x++) {
	    	if (d.getElementById(paginasVistas[x][0]))  {
	    		var sEle = paginasVistas[x][0],
	    			ele = d.getElementById(sEle),
	    			porcentaje = parseFloat(paginasVistas[x][1].replace(',', '.'));

	    		if (sEle.indexOf("porcentaje") > -1 ) {
	    			d.getElementById(sEle+'-graf').style.width = (porcentaje * 0.65) +'%';
	    		}

	    		ele.innerHTML = paginasVistas[x][1];
	    	}
	    }

	    // audiencia
	    for (var x = 0, len = audiencia.length; x < len; x++) {
	    	if (d.getElementById(audiencia[x][0]+'-graf'))  {
	    		var porcentaje = parseFloat(audiencia[x][1].replace(',', '.'));

	    		d.getElementById(audiencia[x][0]+'-graf').style.width = porcentaje + '%';
	    		d.getElementById(audiencia[x][0]).innerHTML = audiencia[x][1];
	    	}
	    }

	    // edades
	    for (var x = 0, len = edades.length; x < len; x++) {
	    	if (d.getElementById(edades[x][0]))  {
	    		var porcentaje = parseFloat(edades[x][1].replace(',', '.'));

	    		d.getElementById(edades[x][0]).innerHTML = edades[x][1];
	    		d.getElementById(edades[x][0]+'-graf').style.height = (100 - porcentaje * 1.2) + '%';
	    	}
	    }

	    // tipos usuarios
	    for (var x = 0, len = tipoUsuarios.length; x < len; x++) {
	    	if (d.getElementById(tipoUsuarios[x][0]))  {
	    		var porcentaje = parseFloat(tipoUsuarios[x][1].replace(',', '.'));

	    		d.getElementById(tipoUsuarios[x][0]).innerHTML = tipoUsuarios[x][1];
	    	}
	    }

	    // sistemas operativos móviles
	    for (var x = 0, len = sistemasOperativosMovil.length; x < len; x++) {
	    	if (d.getElementById(sistemasOperativosMovil[x][0]))  {
	    		d.getElementById(sistemasOperativosMovil[x][0]).innerHTML = sistemasOperativosMovil[x][1];
	    	}
	    }


	   window.onload = function () {
	    	if ( typeof(window.loaded) !== 'undefined' ) {
				d.getElementById('load').style.display = 'none';
				d.getElementById('container').style.display = 'block';
			} else {
				d.getElementById('load').innerHTML = '<h3>Error al recuperar los datos</h3>';
			}

			// genera el grafico de area con los datos del año
		    getAreaChart();

		    // genera el grafico de torta para los datos de los tipos de usuarios
			getPieChartUsers();
      getPieChartFameleMale();
      getPieChartDevices();
      getPieChartMOS();
      getPieChartBrowsers();
		}

	})(window);

EOT;

echo $script;
?>