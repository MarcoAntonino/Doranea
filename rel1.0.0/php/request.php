<?php
require_once("Database.php");

$province=array("ALESSANDRIA","ASTI","BIELLA","CUNEO","NOVARA","TORINO","Verbano_Cusio_Ossola","VERCELLI");
	
$flussoMinimo=100;
	
function get($x){
	if(isset($_GET[$x])){
		if($_GET[$x]!=""){
			return $_GET[$x];
		}
	}
	return false;
}

function post($x){
	if(isset($_POST[$x])){
		if($_POST[$x]!=""){
			return $_POST[$x];
		}
	}
	return false;
}

function getByFrom($from,$year,$sex,$flussoMinimo){
	$matrix=getByYear($year,$sex,$flussoMinimo);
	forEach($matrix as $prov => $arr){
		$out=array();
		forEach($arr as $key => $value){
			if(in_array($value[0],$from))array_push($out,array($value[0],$value[1]));
		}
		$matrix[$prov]=$out;
	}
	return $matrix;
}

function getByYear($year,$sex,$min){
	global $province;
	$DB=new Database();
	$query="SELECT * FROM anno".$DB->link->real_escape_string($year)." WHERE "
	.implode(" OR ",array_map(function($x)use($sex){return "Province='".$x.$sex."'";},$province));
	$data=$DB->select($query);
	if($data==null)
		return null;
	while($row=mysqli_fetch_array($data))
		$migTo[$row[0]]=$row;
	$luoghiPartenza=array();
	forEach($migTo as $prov => $arr){
		$prov=substr($prov,0,strlen($prov)-1);
		$luoghiPartenza[$prov]=array();
		forEach($arr as $key => $value){
			if(!is_numeric($key)){
				if(is_numeric($value) && $value>$min){
					if($key!="Totale" &&
						$key!="Jugoslavia_SerbiaMontenegro" &&
						$key!="Sudan" &&
						substr($key,0,3)!="Per" &&
                        substr($key,0,7)!="Sao_tom" &&
						$key!="Cecoslovacchia")
					array_push($luoghiPartenza[$prov],array($key,$value));
				}
			}
		}
	}
	return $luoghiPartenza;
}

function perctorgb($x){
	$x/=100;
	$g=array(0,255,0);
	$r=array(255,0,0);
	$merge=array_map(function($a,$b)use($x){
		return $a*$x+$b*(1-$x);
	},$g,$r);
	$max=max($merge);
	$merge=array_map(function($a)use($max){
		return $a/$max*255;
	},$merge);
	return "[".intval($merge[1]).",".intval($merge[0]).",".intval($merge[2])."]";
}

function arrayMaker($matrix){
	$maxMin=maxMin($matrix);
	$arrRotte=array();
	forEach($matrix as $prov => $arr){
		forEach($arr as $key => $value){
			if($value[0]!="Apolide" && $value[0]!="Totale" &&
				$value[0]!="Jugoslavia_SerbiaMontenegro" &&
				$value[0]!="Sudan" &&
				substr($value[0],0,3)!="Per" &&
				$value[0]!="Cecoslovacchia"
			)array_push($arrRotte,"\t['".str_replace("_"," ",$value[0])."','".$prov."',".perctorgb((log($value[1])-log($maxMin[1]))/(log($maxMin[0])-log($maxMin[1]))*100).",'".$value[1]."']");
		}
	}
	return "rotte = [".implode(",",$arrRotte)."];";
}

function maxMin($m){
	$max=0;
	$min=10000000;
	forEach($m as $prov => $arr){
		forEach($arr as $key => $value){
			if($value[0]!="Apolide" && $value[0]!="Totale" && $value[1]>$max)$max=$value[1];
			if($value[0]!="Apolide" && $value[0]!="Totale" && $value[1]<$min)$min=$value[1];
		}
	}
	return array($max,$min);
}

function makeArrByYear($year,$sex="T"){
	global $flussoMinimo;
	$matrix=getByYear($year,$sex,$flussoMinimo);
	return arrayMaker($matrix);
}

function makeArrByFrom($from,$year,$sex="T"){
	global $flussoMinimo;
	$matrix=getByFrom($from,$year,$sex,$flussoMinimo);
	return arrayMaker($matrix);
}

function responseGraph($sex,$year,$from=false){
	global $flussoMinimo;
	return ($from==false) ? getByYear($year,$sex,$flussoMinimo) : getByFrom($from,$year,$sex,$flussoMinimo);
}


if(post("getGraphValue")){
	$flussold=$flussoMinimo;
	$flussoMinimo=0;
	if(post("year")!=false){
		if(json_decode(base64_decode(post("from")))!="false")
			echo json_encode(responseGraph(post("sex"),post("year"),json_decode(base64_decode(post("from")))));
		else
			echo json_encode(responseGraph(post("sex"),post("year")));		
	}
	$flussoMinimo=$flussold;
}

if(post("getRadarValue")){
	$flussold=$flussoMinimo;
	$flussoMinimo=0;
	if(post("year")!=false){
		$f=json_decode(base64_decode(post("from")));
		$m2= ($f!="false") ? array(responseGraph("M",post("year"),$f),responseGraph("F",post("year"),$f)) : array(responseGraph("M",post("year")),responseGraph("F",post("year")));
        echo json_encode($m2);
	}
	$flussoMinimo=$flussold;
}































?>
