<?php
function part1($vsebina){
	$biti = array_fill(0,12,0);
	$gama = array();
	$epsilon = array();
	for($i = 0;$i < count($vsebina);$i++){
		$vrstica = str_split($vsebina[$i]);
		for($j = 0;$j < count($vrstica);$j++){
			if($vrstica[$j] == "0"){
				$biti[$j] -= 1;
			} else if($vrstica[$j] == "1"){
				$biti[$j] += 1;
			}
		}
	}
	for($i = 0;$i < count($biti);$i++){
		if($biti[$i] > 0){
			array_push($gama,"1");
			array_push($epsilon,"0");
		} else if($biti[$i] < 0){
			array_push($gama,"0");
			array_push($epsilon,"1");
		}
	}
	$gama_string = implode("",$gama);
	$epsilon_string = implode("",$epsilon);
	$g = bindec($gama_string);
	$e = bindec($epsilon_string);
	return $g * $e;
}

function most_present_bit($tabela,$bit){
	$most_present = "";
	$ena = 0;
	$nic = 0;
	for($i = 0;$i < count($tabela);$i++){
		$vrstica = str_split($tabela[$i]);
		if($vrstica[$bit] == 0){
			$nic += 1;
		}
		else {
			$ena += 1;
		}
	}
	if($nic > $ena){
		return "0";
	} else {
		return "1";
	}		
}


function part2($vsebina){
	$ogr = array();
	$csf = array();
	$ogr_candidates = array();
	$csf_candidates = array();
	$ogr_temp = array();
	$csf_temp = array();
	$prvi_bit = most_present_bit($vsebina,0);
	foreach($vsebina as $vseb){
		$vseb = rtrim($vseb);
		if($prvi_bit == "1"){
			if(str_split($vseb)[0] == "1"){
				array_push($ogr_candidates,$vseb);
			} else {
				array_push($csf_candidates,$vseb);
			}
		} else {
			if(str_split($vseb)[0] == "0"){
				array_push($csf_candidates,$vseb);
			} else {
				array_push($ogr_candidates,$vseb);
			}
		}
	}
	for($i = 1;$i < 12;$i++){
		$najvec_ogr = most_present_bit($ogr_candidates,$i);
		$najvec_csf = most_present_bit($csf_candidates,$i);
		if(count($ogr_candidates) > 1){
			$ogr_temp = $ogr_candidates;
			$ogr_candidates = array();
			foreach($ogr_temp as $ogtmp){
				$vrstica = str_split($ogtmp);
				if($vrstica[$i] == $najvec_ogr){
					array_push($ogr_candidates,$ogtmp);
				}
			}
		}
		if(count($csf_candidates) > 1){
			$csf_temp = $csf_candidates;
			$csf_candidates = array();
			foreach($csf_temp as $ogtmp){
				$vrstica = str_split($ogtmp);
				if($vrstica[$i] != $najvec_csf){
					array_push($csf_candidates,$ogtmp);
				}
			}
		}
	}
	$ogr_string = $ogr_candidates[0];
	$csf_string = $csf_candidates[0];
	$o = bindec($ogr_string);
	$c = bindec($csf_string);
	return $o * $c;
}

$vsebina = explode("\n",file_get_contents("input_day3.txt"));

echo "Part 1 resitev je: ".part1($vsebina)."\n";
echo "Part 2 resitev je: ".part2($vsebina)."\n";

?>