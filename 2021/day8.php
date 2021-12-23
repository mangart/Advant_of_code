<?php
function part1($output){
	$vsota = 0;
	foreach($output as $out){
		foreach($out as $ou){
			$ou = trim($ou);
			$dolzina = strlen($ou);
			switch ($dolzina) {
				case 2:
					$vsota += 1;
					break;
				case 3:
					$vsota += 1;
					break;
				case 4:
					$vsota += 1;
					break;
				case 7:
					$vsota += 1;
					break;
			}			
		}
	}
	return $vsota;
}



function dekodiraj($vrednosti){
	$dekodirane = array();
	$dekodirane[1] = $vrednosti[2][0];
	$dekodirane[4] = $vrednosti[4][0];
	$dekodirane[7] = $vrednosti[3][0];
	$dekodirane[8] = $vrednosti[7][0];
	$dolzine6 = $vrednosti[6];
	$dolzine5 = $vrednosti[5];
	for($i = 0;$i < count($dolzine6);$i++){
		if(vsebuje_vse(str_split($dekodirane[4]),$dolzine6[$i])){
			$dekodirane[9] = $dolzine6[$i];
			array_splice($dolzine6,$i,1);
			break;
		}
	}
	for($i = 0;$i < count($dolzine6);$i++){
		if(vsebuje_vse(str_split($dekodirane[7]),$dolzine6[$i])){
			$dekodirane[0] = $dolzine6[$i];
			array_splice($dolzine6,$i,1);
			break;
		}
	}
	$dekodirane[6] = $dolzine6[0];
	for($i = 0;$i < count($dolzine5);$i++){
		if(vsebuje_vse(str_split($dekodirane[7]),$dolzine5[$i])){
			$dekodirane[3] = $dolzine5[$i];
			array_splice($dolzine5,$i,1);
			break;			
		}
	}
	$locilni_segment = ne_vsebuje(str_split($dekodirane[1]),$dekodirane[6]);
	for($i = 0;$i < count($dolzine5);$i++){
		if(str_contains($dolzine5[$i],$locilni_segment,)){
			$dekodirane[2] = $dolzine5[$i];
			array_splice($dolzine5,$i,1);
			break;			
		}
	}
	$dekodirane[5] = $dolzine5[0];
	return $dekodirane;
}

function vsebuje_vse($glavni,$iskani){
	foreach($glavni as $glav){
		if(!str_contains($iskani,$glav)){
			return false;
		}
	}
	return true;
}

function ne_vsebuje($ena,$sest){
	foreach($ena as $e){
		if(!str_contains($sest,$e)){
			return $e;
		}
	}
	return false;
}

function part2($output){
	$vsota = 0;
	foreach($output as $out){
		$vrednosti = $out[0];
		$izhodi = $out[1];
		$po_dolzini = length_split($vrednosti);
		$dekodirane = array_flip(dekodiraj($po_dolzini));
		$dekodirana_vrednost = 0;
		foreach($izhodi as $izhod){
			$izhod = string_po_abecedi(trim($izhod));
			$dekodirana_vrednost = $dekodirana_vrednost * 10 + $dekodirane[$izhod];
		}
		$vsota += $dekodirana_vrednost;
	}
	return $vsota;
}

function get_unique($output){
	$unikatni = array();
	foreach($output as $out){
		foreach($out as $ou){
			$ou = trim($ou);
			$dolzina = strlen($ou);
			switch ($dolzina) {
				case 2:
					$unikatni[1] = $ou;
					break;
				case 3:
					$unikatni[7] = $ou;
					break;
				case 4:
					$unikatni[4] = $ou;
					break;
				case 7:
					$unikatni[8] = $ou;
					break;
			}			
		}
	}
	return $unikatni;
}

function length_split($vrednosti){
	$dolzinske = array();
	foreach($vrednosti as $vred){
		$dolzina = strlen($vred);
		if(isset($dolzinske[$dolzina])){
			array_push($dolzinske[$dolzina],string_po_abecedi($vred));
		}
		else {
			$dolzinske[$dolzina] = array(string_po_abecedi($vred));
		}
	}
	return $dolzinske;
}
 
function string_po_abecedi($niz){
	$stringParts = str_split($niz);
	sort($stringParts);
	return implode($stringParts); 
}



$lines = explode("\n",file_get_contents("input_day8.txt"));
$values = array();
$output = array();
$vsi = array();
foreach($lines as $line){
	$vrstica = explode(" | ",$line);
	$values1 = explode(" ",$vrstica[0]);
	$output1 = explode(" ",$vrstica[1]);
	array_push($values,$values1);
	array_push($output,$output1);
	array_push($vsi,array($values1,$output1));
}
//var_dump($output);
echo "Part 1 resitev je: ".part1($output)."\n";
echo "Part 2 resitev je: ".part2($vsi)."\n";

?>