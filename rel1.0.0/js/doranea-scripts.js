	var slider = new Slider("#ex16a", {
		ticks: [1993, 1994, 1995, 1996, 1997, 1998, 1999, 2000, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015],
		ticks_snap_bounds: 1
	});
    
	var allSel = false;
    var CostumBaseValue = 2;
    
    allChart= new Array();

	var continenti = {
		Africa: new Array("Algeria", "Angola", "Benin", "Botswana", "Burkina_faso", "Burundi", "Camerun", "Capo_verde", "Repubblica_Centrafricana", "Ciad", "Comore", "Repubblica_Del_Congo", "Repubblica_Democratica_Del_Congo", "Costa_davorio", "Egitto", "Eritrea", "Etiopia", "Gabon", "Gambia", "Ghana", "Gibuti", "Guinea", "Guinea_bissau", "Guinea_equatoriale", "Kenya", "Lesotho", "Liberia", "Libia", "Madagascar", "Malawi", "Mali", "Marocco", "Mauritania", "Mauritius", "Mozambico", "Namibia", "Niger", "Nigeria", "Ruanda", "Senegal", "Seychelles", "Sierra_leone", "Somalia", "Sud_africa", "Sudan", "Swaziland", "Tanzania", "Togo", "Tunisia", "Uganda", "Zambia", "Zimbabwe", "Congo", "Repubblica_Del_Sudan"),
		Europa: new Array("Albania", "Armenia", "Bielorussia", "Bosniaerzegovina", "Bulgaria", "Repubblica_Ceca", "Croazia", "Estonia", "Kazakhstan", "Kosovo", "Lettonia", "Lituania", "Moldova", "Montenegro", "Jugoslavia_SerbiaMontenegro", "Polonia", "Romania", "Russia", "Slovacchia", "Slovenia", "Turchia", "Ucraina", "Ungheria", "Cecoslovacchia", "Repubblica_Di_Macedonia", "Repubblica_Di_Serbia"),
		NordAmerica: new Array("Antigua_e_barbuda", "Bahamas", "Barbados", "Belize", "Costa_rica", "Cuba", "Dominica", "El_salvador", "Giamaica", "Grenada", "Guatemala", "Haiti", "Honduras", "Messico", "Nicaragua", "Panama", "Repubblica_Dominicana", "Saint_kitts_e_nevis", "Saint_vincent_e_grenadine", "Saint_lucia", "Trinidad_e_tobago"),
		SudAmerica: new Array("Argentina", "Bolivia", "Brasile", "Cile", "Colombia", "Ecuador", "Guyana", "Paraguay", "Suriname", "Uruguay", "Venezuela"),
		Asia: new Array("Afghanistan", "Arabia_saudita", "Azerbaigian", "Bahrein", "Bangladesh", "Bhutan", "Brunei", "Cambogia", "Cipro", "Corea_Del_Nord", "Corea_Del_Sud", "Emirati_arabi_uniti", "Filippine", "Georgia", "Giordania", "India", "Indonesia", "Iraq", "Kirghizistan", "Kuwait", "Laos", "Libano", "Maldive", "Malaysia", "Mongolia", "Hong_Kong", "Macao", "Myanmar", "Nepal", "Oman", "Pakistan", "Qatar", "Singapore", "Siria", "Sri_lanka", "Tagikistan", "Taiwan", "Thailandia", "Turkmenistan", "Uzbekistan", "Vietnam", "Yemen", "Repubblica_Islamica_Del_Iran", "Repubblica_Popolare_Cinese", "Territori_dell-autonomia_palestinese")
	};

	function getColor(i) {
    	var color = [
			"F44336", //red
			"E91E63", //pink
			"9C27B0", //purple
			"673AB7", //deep purple
			"3F51B5", //indigo
			"2196F3", //blue
			"03A9F4", //light blue
			"00BCD4", //cyan
			"009688", //teal
			"4CAF50", //green
			"8BC34A", //light green
			"CDDC39", //lime
			"FFEB3B", //yellow
			"FFC107", //amber
			"FF9800", //orange
			"FF5722" //deep orange
		]
		return color[i % color.length];
	}

	function addGraph(data, title, idGraph, tipo, parentPane,logaritmic=false) {
		parentPane.append("<div class='col-md-3'><div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>" + title + "</h3>" +
			"</div><div class='panel-body'><canvas id='" + idGraph + "' width='100' height='100'></canvas></div></div></div>");

		var c = new Chart($("#" + idGraph), {
			data: data,
			type: tipo,
			options: {
				title: {
					display: false,
					text: 'Filtra le fonti:',
					fontColor: '#cccccc'
				},
				legend: {
					display: true,
					labels: {
						fontColor: '#cccccc'
					}
				},
                scale: {
					ticks: {
                    	display: !logaritmic,
						beginAtZero: true,
						fontColor: 'white',
						showLabelBackdrop: false
					},
					pointLabels: {display: false,fontColor: 'white'}
				},tooltips: {
                        callbacks: {
                            title: function() {
                                return '';
                            },
                            label: function(tooltipItem, data) {
                                var dataLabel = data.labels[tooltipItem.index];
                                var value = ': ' + ( logaritmic ? Math.round(Math.pow(Math.E,Math.sqrt(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index], CostumBaseValue))) : data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] );
                                if (Chart.helpers.isArray(dataLabel)) {
                                    dataLabel = dataLabel.slice();
                                    dataLabel[0] += value;
                                } else {
                                    dataLabel += value;
                                }
                                return dataLabel;
                            }
                        }
                    }
			}
		});
        allChart.push(c);
	}

	function aggiornaMappa() {
		var ttt = false;
        allChart=new Array();
        var legendaLength=$('input[name=sex]:checked').val()=="T" ? 12 : 3;
		$("#graphRow").html("<div id='legenda' class='col-md-"+legendaLength+"'><div class='panel panel-default'><div class='panel-heading'>Dati Rappresentati</div><div class='panel-body'><p>Per questioni di leggibilit&agrave; i dati riportati sulla mappa sono filtrati ad un minimo di 100 persone: gli archi vengono pertanto disegnati solo nel caso in cui il totale per ogni singolo stato di provenienza supera tale soglia.</p><p>I valori che compaiono sui grafici, fanno fede invece al numero esatto di persone riportate sul Database. In alcuni grafici, gli stati con cifre meno significative vengono automaticamente accorpati in una voce unica.</p></div></div></div>");
		$('#wrapper').removeClass('active');
		var partenze = $("#provenienza")[0]["selectedOptions"];
		if (partenze.length == 0) {
			ttt = true;
			$('#provenienza option').prop('selected', true);
		}
		var p = new Array();
		for (var i = 0; i < partenze.length; i++) {
			p.push(partenze[i]["value"]);
		}
		var p = btoa(JSON.stringify(p));

		$('.frames').attr({
			'src': 'mappa/index.php?' + "year=" + $("#ex16a").val() + "&from=" + p + "&sex=" + $('input[name=sex]:checked').val()
		});

		if (p != false) {
			setGraph($('input[name=sex]:checked').val(), $("#ex16a").val(), p);
		} else {
			setGraph($('input[name=sex]:checked').val(), $("#ex16a").val());
		}
		if (ttt) $('#provenienza option').prop('selected', false);
	}

	function setPartObj(data) {
		var c = Math.floor(Math.random() * 15);
		var donutGraphDataPart = {
			labels: new Array(),
			datasets: new Array({
				backgroundColor: new Array(),
				borderColor: '#cccccc',
				data: new Array()
			})
		};
		var allPart = makeAllPart(data);

		if (allPart[1].length > 9) {
			allPart[0][9] = "Altro";
			for (var i = 11; i < allPart[1].length; i++) {
				allPart[1][9] += parseInt(allPart[1][i]);
			}
			allPart[0].splice(10);
			allPart[1].splice(10);
		}
		for (var i = 0; i < allPart[0].length; i++) {
			donutGraphDataPart.labels.push(formatText(allPart[0][i]));
			donutGraphDataPart.datasets[0].data.push(allPart[1][i]);
			donutGraphDataPart.datasets[0].backgroundColor.push("#" + getColor(c++));
		}
		return donutGraphDataPart;
	}

	function setContObj(data) {
		var c = Math.floor(Math.random() * 15);
		var donutGraphDataCont = {
			labels: new Array(),
			datasets: new Array({
				backgroundColor: new Array(),
				borderColor: '#cccccc',
				data: new Array()
			})
		};
		var semiTotCont = {
			Africa: 0,
			NordAmerica: 0,
			SudAmerica: 0,
			Europa: 0,
			Asia: 0,
			Oceania: 0
		};
		for (var i in data) {
			data[i].forEach(function(item, i) {
				if (continenti.Africa.indexOf(item[0]) >= 0) semiTotCont.Africa += parseInt(item[1]);
				else if (continenti.Europa.indexOf(item[0]) >= 0) semiTotCont.Europa += parseInt(item[1]);
				else if (continenti.NordAmerica.indexOf(item[0]) >= 0) semiTotCont.NordAmerica += parseInt(item[1]);
				else if (continenti.SudAmerica.indexOf(item[0]) >= 0) semiTotCont.SudAmerica += parseInt(item[1]);
				else if (continenti.Asia.indexOf(item[0]) >= 0) semiTotCont.Asia += parseInt(item[1]);
				else if (continenti.Oceania.indexOf(item[0]) >= 0) semiTotCont.Oceania += parseInt(item[1]);
			});
		};
		for (var i in semiTotCont) {
			donutGraphDataCont.labels.push(formatText(i));
			donutGraphDataCont.datasets[0].data.push(semiTotCont[i]);
			donutGraphDataCont.datasets[0].backgroundColor.push("#" + getColor(c++));
		}
		return donutGraphDataCont;
	}

	function setDestObj(data) {
		var c = Math.floor(Math.random() * 15);
		var donutGraphDataDest = {
			labels: new Array(),
			datasets: new Array({
				backgroundColor: new Array(),
				borderColor: '#cccccc',
				data: new Array()
			})
		};
		for (var i in data) {
			var semiTotDest = new Array(i, 0);
			data[i].forEach(function(item, ii) {
				semiTotDest[1] += parseInt(item[1]);
			});
			donutGraphDataDest.labels.push(formatText(semiTotDest[0]));
			donutGraphDataDest.datasets[0].data.push(Math.pow(Math.log(semiTotDest[1]),CostumBaseValue));
			donutGraphDataDest.datasets[0].backgroundColor.push("#" + getColor(c++));
		};
		return donutGraphDataDest;
	}

	function makeAllPart(data) {
		var allPart = new Array(new Array(), new Array());
		for (var i in data) {
			data[i].forEach(function(item, ii) {
				var j = allPart[0].indexOf(item[0]);
				if (j < 0) {
					allPart[0].push(item[0]);
					allPart[1].push(parseInt(item[1]));
				} else
					allPart[1][j] += parseInt(item[1]);
			});
		}
		for (var i = 0; i < allPart[1].length - 1; i++) {
			var max = i;
			for (var j = i + 1; j < allPart[1].length; j++) {
				if (parseInt(allPart[1][j]) > parseInt(allPart[1][max])) max = j;
			}
			var tmp = allPart[0][max];
			allPart[0][max] = allPart[0][i];
			allPart[0][i] = tmp;
			tmp = allPart[1][max];
			allPart[1][max] = allPart[1][i];
			allPart[1][i] = tmp;
		}
		return allPart;
	}

	function setGraph(sex, year, from = "false") {
		$.post("php/request.php", {
			"getGraphValue": true,
			"year": year,
			"sex": sex,
			"from": from
		}, function(data) {
			data = JSON.parse(data);
			var isNull = 0;
			var n = 0;
			for (var i in data) {
				n++;
				if (data[i].length > 0) isNull++;
			}
			if (isNull == n) {
				addGraph(setDestObj(data),"Province di arrivo", "donutChartDest", "polarArea",$("#graphRow"),true);
				addGraph(setPartObj(data),"Stati di provenienza", "donutChartPart", "doughnut",$("#graphRow"));
				addGraph(setContObj(data),"Continenti di provenienza", "donutChartCont", "doughnut",$("#graphRow"));
				if (sex == "T") addRadar(year, from);
			} else {
				alert("La ricerca non ha prodotto alcun risultato");
			}
		});
	}

	function makeRadarData(data) {
		var returnObj = {
			labels: new Array(),
			datasets: new Array({
				label: "Maschi",
				backgroundColor: "rgba(24,74,144,0.2)",
				borderColor: "rgba(79,123,184,1)",
				pointBackgroundColor: "rgba(51,98,163,1)",
				//pointBorderColor: "#fff",
				//pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(24,74,144,1)",
				data: new Array()
			}, {
				label: "Femmine",
				backgroundColor: "rgba(212,49,126,0.2)",
				borderColor: "rgba(237,115,172,1)",
				pointBackgroundColor: "rgba(226,80,149,1)",
				//pointBorderColor: "#fff",
				//pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(212,49,126,1)",
				data: new Array()
			})
		};

		var allMPart = makeAllPart(data[0]);
		var allFPart = makeAllPart(data[1]);
		allTPart = new Array(new Array(), new Array());
		console.log(allMPart);
		console.log(allFPart);

		allMPart[0].forEach(function(item, i) {
			allTPart[0].push(item);
			allTPart[1].push(parseInt(allMPart[1][i]) + parseInt(allFPart[1][allFPart[0].indexOf(item)]));
		});

		allTPart[0].splice(10);
		allTPart[1].splice(10);

		allTPart[0].forEach(function(item, i) {
			returnObj.labels.push(formatText(item));
			returnObj.datasets[0].data.push(Math.pow(Math.log(allMPart[1][allMPart[0].indexOf(item)]),CostumBaseValue));
			returnObj.datasets[1].data.push(Math.pow(Math.log(allFPart[1][allFPart[0].indexOf(item)]),CostumBaseValue));
		});
		return returnObj;

	}

	function setRadar(data, title, idGraph, parentPane) {
		parentPane.append("<div class='col-md-3'><div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>" + title + "</h3>" +
			"</div><div class='panel-body'><canvas id='" + idGraph + "' width='100' height='100'></canvas></div></div></div>");

		var c = new Chart($("#" + idGraph), {
			type: 'radar',
			data: makeRadarData(data),
			options: {
				legend: {
					position: 'top',
					labels: {
						fontColor: 'white'
					}
				},
				title: {
					display: false,
					text: 'Suddivisione Maschi Femmine',
					fontColor: 'white'
				},
                //scale: {display: false}
				scale: {
					ticks: {
                    	display: false,
						beginAtZero: true,
						fontColor: 'white',
						showLabelBackdrop: false
					},
					pointLabels: {display: false,fontColor: 'white'},
					gridLines: {color: 'rgba(255, 255, 255, 0.2)'},
					angleLines: {color: 'white'}
				},tooltips: {
                        callbacks: {
                            title: function() {
                                return '';
                            },
                            label: function(tooltipItem, data) {
                                var dataLabel = data.labels[tooltipItem.index];
                                var value = ': ' + Math.round(Math.pow(Math.E,Math.sqrt(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index],CostumBaseValue)));
                                if (Chart.helpers.isArray(dataLabel)) {
                                    dataLabel = dataLabel.slice();
                                    dataLabel[0] += value;
                                } else {
                                    dataLabel += value;
                                }
                                return dataLabel;
                            }
                        }
                    }
			}
		});
        allChart.push(c);
	}

	function addRadar(year, from) {
		$.post("php/request.php", {
			"getRadarValue": true,
			"year": year,
			"from": from
		}, function(data) {
			data = JSON.parse(data);
			var isNull = 0;
			var n = 0;
            var limitThree=false;
			for (var i in data[0]) {
				n += 2;
				if (data[0][i].length > 0){isNull++;if(data[0][i].length > 2)limitThree=true;}
				if (data[1][i].length > 0){isNull++;if(data[0][i].length > 2)limitThree=true;}
			}
			if (isNull == n && limitThree) {
				setRadar(data, "Suddivisione maschi - femmine", "radarChartMF", $("#graphRow"));
			} else {
				console.log("No Radar Data");
				console.log("year: " + year);
				console.log("from: " + from);
                $("#legenda").attr("class","col-md-3");
			}
		});
	}

	function formatText(str) {
		if (str == "Verbano_Cusio_Ossola")
			return "Verbano-Cusio-Ossola";
		str = str.replace(/\_/g, ' ').replace(/\-/g, "'").toLowerCase();
		str = str.charAt(0).toUpperCase() + str.substr(1);
		return str.substr(0, 10) == "Repubblica" ? acronymGen(str) : str;
	}

	function acronymGen(str) {
		var part = str.split(" ");
		part.forEach(function(item, i) {
			if (i < part.length - 1) part[i] = part[i][0].toUpperCase();
			else part[i] = part[i][0].toUpperCase() + part[i].substr(1).toLowerCase();
		});
		return part.join(".");
	}
	/**
	function formatText(str){
	  if(str=="V.C.O.")
		return str;
	  str=str.replace(/\_/g, ' ').replace(/\-/g, "'").toLowerCase();
	  return str.charAt(0).toUpperCase()+str.substr(1);
	}
	/**/
	$('#tutti').click(function() {
		if (!checkSel()) {
			$('.dropdown-menu li a').click();
		}
	});

	function checkSel() {
		aset = false;
		$('.dropdown-menu li a').each(function() {
			if ($(this).attr("aria-selected") == "true") {
				aset = true;
				$(this).click();
			}
		});
		return aset;
	}
	$(window).on('load', function() {
		$("#sidebar-wrapper").css("display", "block");
	});