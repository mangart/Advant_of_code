<?php
function part1($bingo,$matrike){
	$oznacene = inicializiraj_oznacene($matrike);
	foreach($bingo as $bin){
		for($i = 0;$i < count($matrike);$i++){
			for($j = 0;$j < count($matrike[$i]);$j++){
				for($k = 0;$k < count($matrike[$i][$j]);$k++){
					if($matrike[$i][$j][$k] == $bin){
						$oznacene[$i][$j][$k] = true;
					}
				}
			}
		}
		$mat = preveri_matrike($oznacene);
		$vsota = 0;
		if($mat){
			for($i = 0;$i < count($matrike[$mat]);$i++){
				for($j = 0;$j < count($matrike[$mat][$i]);$j++){
					if(!$oznacene[$mat][$i][$j]){
						$vsota += $matrike[$mat][$i][$j];
					}
				}
			}
			return $vsota * $bin;
		}
	}
}


function inicializiraj_oznacene($matrike){
	$oznacene = array();
	for($i = 0;$i < count($matrike);$i++){
		for($j = 0;$j < count($matrike[$i]);$j++){
			for($k = 0;$k < count($matrike[$i][$j]);$k++){
				$oznacene[$i][$j][$k] = false;
			}
		}
	}
	return $oznacene;
}
function preveri_matrike($matrike){
	for($i = 0;$i < count($matrike);$i++){
		if(preveri_matriko($matrike[$i])){
			return $i;
		}
	}
	return false;
}

function preveri_metrike1($matrike,&$markirane,&$stevec){
	for($i = 0;$i < count($matrike);$i++){
		if(preveri_matriko($matrike[$i])){
			if(!isset($markirane
		}
	}
}

function preveri_matriko($matrika){
	for($i = 0;$i < count($matrika);$i++){
		if(preveri_vrstico($matrika,$i)){
			return true;
		}
		if(preveri_stolpec($matrika,$i)){
			return true;
		}
	}
	return false;
}

function preveri_vrstico($matrika,$i){
	$stevec = 0;
	for($j = 0;$j < count($matrika[$i]);$j++){
		if($matrika[$i][$j]){
			$stevec += 1;
		}
	}
	if($stevec == count($matrika[$i])){
		return true;
	}
	return false;
}

function preveri_stolpec($matrika,$j){
	$stevec = 0;
	for($i = 0;$i < count($matrika[$j]);$i++){
		if($matrika[$i][$j]){
			$stevec += 1;
		}
	}
	if($stevec == count($matrika[$j])){
		return true;
	}
	return false;
}

function part2($bingo,$matrike){
	$oznacene = inicializiraj_oznacene($matrike);
	$zmagovalne_matrike = array();
	foreach($bingo as $bin){
		for($i = 0;$i < count($matrike);$i++){
			for($j = 0;$j < count($matrike[$i]);$j++){
				for($k = 0;$k < count($matrike[$i][$j]);$k++){
					if($matrike[$i][$j][$k] == $bin){
						$oznacene[$i][$j][$k] = true;
					}
				}
			}
		}
		$mat = preveri_matrike($oznacene);
		$vsota = 0;
		if($mat){
			if(!isset($zmagovalne_matrike[$mat])){
				$zmagovalne_matrike[$ma
			return $vsota * $bin;
			}
		}
	}
}

$vsebina = explode("\n",file_get_contents("input_day4.txt"));
$vsebina[0] = trim($vsebina[0]);
$bingo = array_map('intval',explode(",",$vsebina[0]));
//var_dump($bingo);
//var_dump($vsebina);
$matrike = array();
$matrika = array();
for($i = 2;$i < count($vsebina);$i++){
	if(strlen($vsebina[$i]) > 5){
		$vsebina[$i] = trim($vsebina[$i]);
		$vrstica = explode(" ",$vsebina[$i]);
		for($k = 0;$k < count($vrstica);$k++){
			if(isset($vrstica[$k]) && strlen($vrstica[$k]) == 0){
				array_splice($vrstica, $k, 1);
				$k = $k - 1;
				//echo "'".$vrstica[$k]."'\n";
			}
		}
		$vrstica = array_map('intval',$vrstica);
		array_push($matrika,$vrstica);
	} 
	else {
		array_push($matrike,$matrika);
		$matrika = array();
	}
}
array_push($matrike,$matrika);
//var_dump($matrike);

echo "Part 1 resitev je: ".part1($bingo,$matrike)."\n";
echo "Part 2 resitev je: ".part2($bingo,$matrike)."\n";

?>