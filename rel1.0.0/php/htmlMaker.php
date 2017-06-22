<?php
require_once("Database.php");

function makeFromInsert() {
	$DB=new Database();
	global $anni;
	$out="";
	$query="SELECT COLUMN_NAME FROM information_schema.columns WHERE "
		.implode(" OR ",array_map(function ($x){return "TABLE_NAME='anno".$x."'";},$anni))
		." GROUP BY COLUMN_NAME";
	$data=$DB->select($query);
	$out.="<select class='selectpicker' id='provenienza' multiple >\n";
	if($data!=null){
		while($row=mysqli_fetch_array($data)){
			if($row[0]!="Sesso" && 
				$row[0]!="Province" && 
				$row[0]!="Apolide" && 
				$row[0]!="Totale" && 
				substr($row[0],0,3)!="Per" &&
				substr($row[0],0,7)!="Sao_tom")$out.="<option value='".$row[0]."'>".str_replace("-","&#39; ",str_replace("_"," ",$DB->link->real_escape_string($row[0])))."</option>\n";
		}
	}
	return $out."</select>\n";
}

function makeToInsert(){
	$DB=new Database();
	$out="";
	$query="SELECT Province FROM anno1993";
	$data=$DB->select($query);
	$out.="<select multiple id='arrivo'>\n";
	$nomi=array();
	if($data!=null){
		while($row=mysqli_fetch_array($data)){
			$pr=str_replace("_"," ",$DB->link->real_escape_string($row[0]));
			$pr=substr($pr,0,strlen($pr)-1);
			if($pr=="Totale")
				continue;
			if(!in_array($pr,$nomi)){
				array_push($nomi,$pr);
				$out.="<option value='".$pr."'>".$pr."</option>\n";
			}
		}
	}
	return $out."</select>\n";
}

function makeYearInsert($sel){
	$anni=array(1993,1994,1995,1996,1997,1998,1999,2000,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015);
	return "<select id='year'><option value='All'>.</option>\n"
		.implode("\n",array_map(function($x)use($sel){return "<option value='".$x."'".($x==$sel?"selected":"").">".$x."</option>";},$anni))
		."\n</select>\n";
}

?>
