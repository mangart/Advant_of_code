<?php

// function for initialization and construction of the grid from input file
function init($file,$size,&$grid,&$cords){
	$lines = file($file);
	$grid = array();
	for($i = 0;$i < $size;$i++){
		$str = str_repeat(".",$size);
		$str = str_split($str);
		array_push($grid,$str);
	}
	
	foreach($lines as $line) {
		$line = trim($line);
		array_push($cords,$line);
	}
}





function part1SetUp(&$grid,$cords,$simBytes){
	for($i = 0;$i < $simBytes;$i++){
		$xy = array_map("intval",explode(",",$cords[$i]));
		$grid[$xy[1]][$xy[0]] = "#";
	}
}


function part1($grid,$gridSize){
	$visited = array();
	$directions = array(array(-1,0),array(0,-1),array(1,0),array(0,1));
	$queue = new SplQueue();

	$queue->enqueue([0,0,0]); // x, y, distance
	$visited["0:0"] = true;
	
	while(!$queue->isEmpty()){
		[$i, $j, $dist] = $queue->dequeue();
		if($i == ($gridSize - 1) && $j == ($gridSize - 1)){
            return $dist;
        }
		
		foreach($directions as [$di,$dj]){
			$newi = $i + $di;
			$newj = $j + $dj;
			if(isset($grid[$newi][$newj]) && $grid[$newi][$newj] != '#' && !isset($visited[$newi][$newj])){
                    $visited[$newi][$newj] = true;
                    $queue->enqueue([$newi, $newj, $dist + 1]);
            }
		}
	}
	return false;
}




function part2($grid,$cords,$gridSize,$simBytes){
	for($i = $simBytes;$i < count($cords);$i++){
		$xy = array_map("intval", explode(",", $cords[$i]));
		$grid[$xy[1]][$xy[0]] = "#";
		if(!part1($grid,$gridSize)){
			return $cords[$i];
		}
	}
	return -1;
}




$grid = array();
$cords = array();

$gridSize = 71;
$simBytes = 1024;
init('day18_input.txt',$gridSize,$grid,$cords);

//var_dump($cords);

part1SetUp($grid,$cords,$simBytes);
/*
for($i = 0;$i < count($grid);$i++){
	for($j = 0;$j < count($grid[$i]);$j++){
		echo $grid[$i][$j];
	}
	echo "\n";
}*/


$srt = microtime(true);
echo "The checksum is: ".part1($grid,$gridSize)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

$srt = microtime(true);
echo "The checksum is: ".part2($grid,$cords,$gridSize,$simBytes)."\n";
echo ($time_elapsed_secs = microtime(true) - $srt)."\n";

?>