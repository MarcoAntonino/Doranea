<!doctype html>
<?php
	require_once("../php/config.php");
	require_once("../php/Database.php");
	require_once("../php/request.php");
	require_once("../php/htmlMaker.php");
	
	$year=get("year");
	$from=get("from");
	$sex=get("sex");
	
	if($sex==false)
		$sex="T";
?>
<html>

<head>
	<meta charset='UTF-8' />
	<title>Test Mappa</title>
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">
    <style>
		body {
			margin: 0;
			padding: 0;
			overflow: hidden;
			font: normal 14px/100% "Andale Mono", AndaleMono, monospace;
		}
		
		#legenda {
			position: absolute;
			top: 0;
			left:0;
			z-index: 1;
		}
		#legenda{
        	left: 3px;
			top: 3px;
			height: 20px;
			width: 90px;
		}
		#imgLegenda{
			height: 20px;
			width: 90px;
		}
		.valMin{
			float:left;
			color:#00FF00;
		}
		.valMax{
			float:right;
			color:#FF0000;
		}
        .red1{color:#EC0600;}
        .red2{color:#FF3B17;}
        .red3{color:#FF6017;}
		.valLegenda{
			font: normal 10px/100% "Andale Mono", AndaleMono, monospace;
		}
	</style>
	<script src='jquery-3.0.0.min.js'></script>
    <script>
		var rotte = [];
		
		function getMax(r){
			var max=0;
			for(var i=0;i<r.length;i++){
				if(r[i][3]>max)max=r[i][3];
			}
			return max==0 ? 1000 : max;
		}
		
		function makeRotte(r){
			var out=new Array();
			for(var i=0;i<r.length;i++){
				out.push(new Array(r[i][0],r[i][1],r[i][2]));
			}
			return out;
		}
		
		
		
		$(document).ready(function() {
			$("#valMax").html(getMax(rotte));
		});
		
	</script>
</head>
<body>
	<script src='finalDarks.js'></script>
	<?php
		if($year!=false){
			if(json_decode(base64_decode($from))==false)
				echo "<script>".makeArrByYear($year,$sex)."</script>";
			else
				echo "<script>".makeArrByFrom(json_decode(base64_decode($from)),$year,$sex)."</script>";
		}
	?>
	<div id="legenda">
    <div class="onTop">
    	<i class="fa fa-male valMin" aria-hidden="true"></i>
        <i class="fa fa-male valMax red1" aria-hidden="true"></i>
        <i class="fa fa-male valMax red2" aria-hidden="true"></i>
        <i class="fa fa-male valMax red3" aria-hidden="true"></i>
    </div>
		<img id="imgLegenda" src="img/legenda.png" />
        <label class="valLegenda valMin">100</label><label class="valLegenda valMax" id="valMax"></label>
	</div>
	<script>
		rendergraph(makeRotte(rotte));
		$(".mapboxgl-control-container").hide();
	</script>
</body>
</html>
