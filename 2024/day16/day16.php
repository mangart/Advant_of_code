<?php

// function for initialization and construction of the grid from input file
function init($file,&$grid){
	$lines = file($file);
	$phase = 0;
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}
}

function get_counts($grid,&$counts,&$start,&$end){
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if($grid[$i][$j] != '#'){
				if($grid[$i][$j] == "S"){
					$temp = array();
					$temp['dist'] = 0;
					$temp['visited'] = false;
					$temp['direction'] = "E";
					$counts[$i.":".$j] = $temp;
					$start = $i.":".$j;
				} else {
					$temp = array();
					$temp['dist'] = INF;
					$temp['visited'] = false;
					$temp['direction'] = "";
					$counts[$i.":".$j] = $temp;
					if($grid[$i][$j] == "E"){
						$end = $i.":".$j;
					}
				}
			}
		}
	}
}

function get_direction($direction,&$i,&$j){
	if($direction == "N"){
		$i = -1;
		$j = 0;
	} else if($direction == "E"){
		$i = 0;
		$j = 1;
	} else if($direction == "W"){
		$i = 0;
		$j = -1;
	} else if($direction == "S"){
		$i = 1;
		$j = 0;
	}
}


function get_costs($direction){
	$turns = array();
	$indexes = array("N" => 0,"E" => 1, "S" => 2, "W" => 3);
	$rIndexes = array(0 => "N", 1 => "E", 2 => "S", 3 => "W");
	$curInd = $indexes[$direction];
	$curInd += 4;
	$leftInd = ($curInd + 1) % 4;
	$rightInd = ($curInd - 1) % 4;
	$oposInd = ($curInd + 2) % 4;
	$leftDir = $rIndexes[$leftInd];
	$rightDir = $rIndexes[$rightInd];
	$oposDir = $rIndexes[$oposInd];
	$curInd = $curInd % 4;
	$current = array();
	$current['ind'] = $curInd;
	$current['dir'] = $direction;
	$current['cost'] = 1;
	array_push($turns,$current);
	$current = array();
	$current['ind'] = $leftInd;
	$current['dir'] = $leftDir;
	$current['cost'] = 1001;
	array_push($turns,$current);
	$current = array();
	$current['ind'] = $rightInd;
	$current['dir'] = $rightDir;
	$current['cost'] = 1001;
	array_push($turns,$current);
	$current = array();
	$current['ind'] = $oposInd;
	$current['dir'] = $oposDir;
	$current['cost'] = 2001;
	array_push($turns,$current);
	return $turns;
}
function part1($grid){
	$counts = array();
	$start = "";
	$end = "";
	$queue = new SplPriorityQueue();
	get_counts($grid,$counts,$start,$end);
	$queue->insert($start,-$counts[$start]['dist']);
	while(!$queue->isEmpty()){
		$elementKey = $queue->extract();
		$counts[$elementKey]['visited'] = true;
		$element = $counts[$elementKey];
		$costs = get_costs($element['direction']);
		$deli = array_map("intval",explode(":",$elementKey));
		$origI = $deli[0];
		$origJ = $deli[1];
		foreach($costs as $cost){
			$i = 0;
			$j = 0;
			get_direction($cost['dir'],$i,$j);
			$newI = $origI + $i;
			$newJ = $origJ + $j;
			$stringKey = $newI.":".$newJ;
			$newCost = $element['dist'] + $cost['cost'];
			if(isset($counts[$stringKey])){
				if($counts[$stringKey]['dist'] == INF || $counts[$stringKey]['dist'] > $newCost){
					$counts[$stringKey]['dist'] = $newCost;
					$counts[$stringKey]['direction'] = $cost['dir'];
				}
				if(!$counts[$stringKey]['visited']){
					$queue->insert($stringKey,-$counts[$stringKey]['dist']);
				}
			}
		}	
	}
	return $counts[$end]['dist'];
}

function part2($grid){

	return;
}




$grid = array();
init('day16_input.txt',$grid);


$start = microtime(true);
echo "The checksum is: ".part1($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>