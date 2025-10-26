<?php

function init($file, &$grid) {
    $lines = file($file);

    foreach ($lines as $line) {
        $line = trim($line);
        $line = str_split($line);
		array_push($grid,$line);
        
    }
}

function getPath($grid,&$start,&$path,&$reversePath){
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] == "S"){
				$start = "$i:$j";
				break;
			}
		}
	}
	$end = false;
	$deli = array_map("intval",explode(":",$start));
	$count = 0;
	$temp = array();
	$temp["i"] = $deli[0];
	$temp["j"] = $deli[1];
	array_push($path,$temp);
	$reversePath[$deli[0]][$deli[1]] = $count;
	$count += 1;
	while(!$end){
		$trenutni = $path[count($path)-1];
		if($grid[$trenutni["i"]][$trenutni["j"]] == "E"){
			$end = true;
			continue;
		}
		if(!isset($reversePath[$trenutni["i"]+1][$trenutni["j"]]) && $grid[$trenutni["i"]+1][$trenutni["j"]] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"] + 1;
			$temp["j"] = $trenutni["j"];
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;
			
		} else if(!isset($reversePath[$trenutni["i"]-1][$trenutni["j"]]) && $grid[$trenutni["i"]-1][$trenutni["j"]] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"] - 1;
			$temp["j"] = $trenutni["j"];
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		} else if(!isset($reversePath[$trenutni["i"]][$trenutni["j"]-1]) && $grid[$trenutni["i"]][$trenutni["j"]-1] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"];
			$temp["j"] = $trenutni["j"] - 1;
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		} else if(!isset($reversePath[$trenutni["i"]][$trenutni["j"]+1]) && $grid[$trenutni["i"]][$trenutni["j"]+1] != "#"){
			$temp = array();
			$temp["i"] = $trenutni["i"];
			$temp["j"] = $trenutni["j"] + 1;
			array_push($path,$temp);
			$reversePath[$temp["i"]][$temp["j"]] = $count;
			$count += 1;			
		}
		
	}
}



function part1($grid,&$start,$minCost,&$path,&$reversePath) {
	$numPaths = 0;
	getPath($grid,$start,$path,$reversePath);
	for($i = 0;$i < count($path);$i++){
		$origI = $path[$i]["i"];
		$origJ = $path[$i]["j"];
		// north coordinates
		$iN = $origI - 2;
		$jN = $origJ;
		// east coordinates
		$iE = $origI;
		$jE = $origJ + 2;
		// south coordinates
		$iS = $origI + 2;
		$jS = $origJ;
		// west coordinates
		$iW = $origI;
		$jW = $origJ - 2;
		if(isset($reversePath[$iN][$jN]) && $reversePath[$origI][$origJ] < $reversePath[$iN][$jN]){
			$cost = $reversePath[$iN][$jN] - ($reversePath[$origI][$origJ] + 2);
			if($cost >= $minCost){
				$numPaths += 1;
			}
		}
		if(isset($reversePath[$iE][$jE]) && $reversePath[$origI][$origJ] < $reversePath[$iE][$jE]){
			$cost = $reversePath[$iE][$jE] - ($reversePath[$origI][$origJ] + 2);
			if($cost >= $minCost){
				$numPaths += 1;
			}			
		}
		if(isset($reversePath[$iS][$jS]) && $reversePath[$origI][$origJ] < $reversePath[$iS][$jS]){
			$cost = $reversePath[$iS][$jS] - ($reversePath[$origI][$origJ] + 2);
			if($cost >= $minCost){
				$numPaths += 1;
			}			
		}
		if(isset($reversePath[$iW][$jW]) && $reversePath[$origI][$origJ] < $reversePath[$iW][$jW]){
			$cost = $reversePath[$iW][$jW] - ($reversePath[$origI][$origJ] + 2);
			if($cost >= $minCost){
				$numPaths += 1;
			}			
		}
	}
	return $numPaths;
}

function getManhattanPoints($start,$radius){
	$deli = array_map("intval",explode(":",$start));
	$x0 = $deli[1];
	$y0 = $deli[0];
	$points = array();
	for($i = -$radius;$i < $radius + 1;$i++){
		# The allowed |dy| range shrinks as |dx| increases
		$max_dy = $radius - abs($i);
		for($j = -$max_dy;$j < $max_dy + 1;$j++){ 
			array_push($points,array($x0 + $i,$y0 + $j));
		}
	}
	echo "Tocke: ".count($points)."\n";
	return $points;
}

function manhattanDistance($x0,$x1,$y0,$y1){
	return abs($x1-$x0) + abs($y1-$y0);
}
function part2($grid,$start,$minCost,$radius,$path,$reversePath){
	$pathLength = count($path);
	$vsota = 0;
	for($k = 0;$k < $pathLength - 100;$k++){
		$deli = array_map("intval",explode(":",$start));
		$x0 = $path[$k]["j"];
		$y0 = $path[$k]["i"];
		for($i = -$radius;$i < $radius + 1;$i++){
			# The allowed |dy| range shrinks as |dx| increases
			$max_dy = $radius - abs($i);
			for($j = -$max_dy;$j < $max_dy + 1;$j++){ 
				$j1 = $x0 + $i;
				$i1 = $y0 + $j;
				if(isset($reversePath[$i1][$j1]) && $reversePath[$i1][$j1] > $reversePath[$y0][$x0]){
					$cost = manhattanDistance($y0,$i1,$x0,$j1);
					$savedCost = $reversePath[$i1][$j1] - ($reversePath[$y0][$x0] + $cost);
					if($savedCost >= $minCost){
						$vsota += 1;
					}
				}
			}
		}
	}
	return $vsota;
}

$grid = array();
$path = array();
$reversePath = array();
$start = "";
$minCost = 100;
$radius = 20;

init('day20_input.txt',$grid);


$srt = microtime(true);
echo "The checksum is: ".part1($grid,$start,$minCost,$path,$reversePath)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($grid,$start,$minCost,$radius,$path,$reversePath)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>