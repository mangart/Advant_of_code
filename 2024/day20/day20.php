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



function part1($grid,$start,$minCost) {
	$path = array();
	$reversePath = array();
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

function part2(){

}

$grid = array();
$start = "";
$minCost = 100;
init('day20_input.txt', $grid);

$valid = [];
$srt = microtime(true);
echo "The checksum is: " . part1($grid,$start,$minCost) . "\n";
echo (microtime(true) - $srt) . " seconds\n";

$srt = microtime(true);
echo "The checksum is: " . part2() . "\n";
echo (microtime(true) - $srt) . " seconds\n";

?>