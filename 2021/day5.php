<?php
function part1($glavna,$prehodi){
	foreach($prehodi as $prehod){
		if($prehod['x1'] == $prehod['x2']){
			belezi_x($glavna,$prehod['y1'],$prehod['y2'],$prehod['x1']);
		}
		if($prehod['y1'] == $prehod['y2']){
			belezi_y($glavna,$prehod['x1'],$prehod['x2'],$prehod['y1']);
		}
	}
	$vsota = 0;
	for($i = 0;$i < count($glavna);$i++){
		for($j = 0;$j < count($glavna[$i]);$j++){
			if($glavna[$i][$j] > 1){
				$vsota += 1;
			}
		}
	}
	//debug_izpis($glavna);
	return $vsota;
}

function belezi_x(&$glavna,$x1,$x2,$y){
	if($x1 > $x2){
		$temp = $x2;
		$x2 = $x1;
		$x1 = $temp;
	}
	for($i = $x1;$i <= $x2;$i++){
		$glavna[$i][$y] += 1;
	}
}

function belezi_y(&$glavna,$y1,$y2,$x){
	if($y1 > $y2){
		$temp = $y2;
		$y2 = $y1;
		$y1 = $temp;
	}	
	for($i = $y1;$i <= $y2;$i++){
		$glavna[$x][$i] += 1;
	}
}

function belezi_xy(&$glavna,$y1,$y2,$x1,$x2){
	if(($y1 < $y2 && $x1 < $x2)){
		for($x = $x1,$y = $y1;$x <= $x2 && $y <= $y2;$x++,$y++){
			$glavna[$y][$x] += 1;
		}
	} 
	else if($y1 > $y2 && $x1 > $x2){
		for($x = $x1,$y = $y1;$x >= $x2 && $y >= $y2;$x--,$y--){
			$glavna[$y][$x] += 1;
		}		
	}
	else if($y1 > $y2 && $x1 < $x2){
		for($x = $x1,$y = $y1;$x <= $x2 && $y >= $y2;$x++,$y--){
			$glavna[$y][$x] += 1;
		}		
	}
	else if($y1 < $y2 && $x1 > $x2){
		for($x = $x1,$y = $y1;$x >= $x2 && $y <= $y2;$x--,$y++){
			$glavna[$y][$x] += 1;
		}		
	}
}

function part2($glavna,$prehodi){
	foreach($prehodi as $prehod){
		if($prehod['x1'] == $prehod['x2']){
			belezi_x($glavna,$prehod['y1'],$prehod['y2'],$prehod['x1']);
		}
		else if($prehod['y1'] == $prehod['y2']){
			belezi_y($glavna,$prehod['x1'],$prehod['x2'],$prehod['y1']);
		}
		else {
			belezi_xy($glavna,$prehod['y1'],$prehod['y2'],$prehod['x1'],$prehod['x2']);
		}

	}
	$vsota = 0;
	for($i = 0;$i < count($glavna);$i++){
		for($j = 0;$j < count($glavna[$i]);$j++){
			if($glavna[$i][$j] > 1){
				$vsota += 1;
			}
		}
	}
	return $vsota;
	
}

function debug_izpis($glavna){
	for($i = 0;$i < count($glavna);$i++){
		for($j = 0;$j < count($glavna[$i]);$j++){
			echo $glavna[$i][$j]." ";
		}
		echo "\n";
	}
}
$vsebina = explode("\n",file_get_contents("input_day5.txt"));
//var_dump($bingo);
//var_dump($vsebina);
$prehodi = array();
$glavna = array();
$maxX = 0;
$maxY = 0;
for($i = 0;$i < count($vsebina);$i++){
	$vsebina[$i] = trim($vsebina[$i]);
	$vmes = explode(" -> ",$vsebina[$i]);
	$zacetek = array_map('intval',explode(",",$vmes[0]));
	$konec = array_map('intval',explode(",",$vmes[1]));
	if($maxX < $zacetek[0]){
		$maxX = $zacetek[0];
	}
	if($maxX < $konec[0]){
		$maxX = $konec[0];
	}
	if($maxY < $zacetek[1]){
		$maxY = $zacetek[1];
	}
	if($maxY < $konec[1]){
		$maxY = $konec[1];
	}
	$tabela = array();
	$tabela['x1'] = $zacetek[0];
	$tabela['x2'] = $konec[0];
	$tabela['y1'] = $zacetek[1];
	$tabela['y2'] = $konec[1];
	array_push($prehodi,$tabela);
}

$dimenzija = $maxX > $maxY ? $maxX+1 : $maxY+1;
for($i = 0;$i < $dimenzija;$i++){
	for($j = 0;$j < $dimenzija;$j++){
		$glavna[$i][$j] = 0;
	}
}

echo "Part 1 resitev je: ".part1($glavna,$prehodi)."\n";
echo "Part 2 resitev je: ".part2($glavna,$prehodi)."\n";

?>