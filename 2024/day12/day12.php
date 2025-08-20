<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$gridLine = str_split($line);
		array_push($grid,$gridLine);
	}
	return $grid;	
}


/**
Function to retrive all regions of the grid
$regions // array of regions
$lookupRegion // array of lookup regions
$i // index of grid row
$j // index or grid column
$id // id of the region
$symbol // symbol of the region

*/

function getRegions(&$regions,$i,$j,&$taken,$grid,$id,$symbol){
	if(!isset($taken[$i][$j])){
		if($grid[$i][$j] == $symbol){
			array_push($regions[$id],array($i,$j));
			$taken[$i][$j] = true;
			if(isset($grid[$i+1][$j])){
				getRegions($regions,$i+1,$j,$taken,$grid,$id,$symbol);
			}
			if(isset($grid[$i-1][$j])){
				getRegions($regions,$i-1,$j,$taken,$grid,$id,$symbol);
			}
			if(isset($grid[$i][$j+1])){
				getRegions($regions,$i,$j+1,$taken,$grid,$id,$symbol);
			}
			if(isset($grid[$i][$j-1])){
				getRegions($regions,$i,$j-1,$taken,$grid,$id,$symbol);
			}
		}
	}
	return;
}

function getRegionCount($region,$grid,$symbol){
	$count = 0;
	foreach($region as $reg){
		if(isset($grid[$reg[0]-1][$reg[1]])){
			if($grid[$reg[0]-1][$reg[1]] != $symbol){
				$count += 1;
			}
		} else {
			$count += 1;
		}
		
		if(isset($grid[$reg[0]+1][$reg[1]])){
			if($grid[$reg[0]+1][$reg[1]] != $symbol){
				$count += 1;
			}
		} else {
			$count += 1;
		}
		
		if(isset($grid[$reg[0]][$reg[1]+1])){
			if($grid[$reg[0]][$reg[1]+1] != $symbol){
				$count += 1;
			}
		} else {
			$count += 1;
		}
		
		if(isset($grid[$reg[0]][$reg[1]-1])){
			if($grid[$reg[0]][$reg[1]-1] != $symbol){
				$count += 1;
			}
		} else {
			$count += 1;
		}
	}
	return $count;
}

function getEdges($region,$grid,$symbol){
	$edges = array();
	$count = 0;
	foreach($region as $reg){
		if(isset($grid[$reg[0]-1][$reg[1]])){
			if($grid[$reg[0]-1][$reg[1]] != $symbol){
				if(!isset($edges["N"][$reg[0]-1])){
					$edges["N"][$reg[0]-1] = array($reg[1]);
				} else {
					array_push($edges["N"][$reg[0]-1],$reg[1]);
				}
			}
		} else {
			if(!isset($edges["N"][$reg[0]-1])){
					$edges["N"][$reg[0]-1] = array($reg[1]);
				} else {
					array_push($edges["N"][$reg[0]-1],$reg[1]);
				}
		}
		if(isset($grid[$reg[0]+1][$reg[1]])){
			if($grid[$reg[0]+1][$reg[1]] != $symbol){
				if(!isset($edges["S"][$reg[0]+1])){
					$edges["S"][$reg[0]+1] = array($reg[1]);
				} else {
					array_push($edges["S"][$reg[0]+1],$reg[1]);
				}
			}
		} else {
			if(!isset($edges["S"][$reg[0]+1])){
					$edges["S"][$reg[0]+1] = array($reg[1]);
				} else {
					array_push($edges["S"][$reg[0]+1],$reg[1]);
				}
		}
		
		if(isset($grid[$reg[0]][$reg[1]+1])){
			if($grid[$reg[0]][$reg[1]+1] != $symbol){
				if(!isset($edges["E"][$reg[1]+1])){
					$edges["E"][$reg[1]+1] = array($reg[0]);
				} else {
					array_push($edges["E"][$reg[1]+1],$reg[0]);
				}
			}
		} else {
			if(!isset($edges["E"][$reg[1]+1])){
					$edges["E"][$reg[1]+1] = array($reg[0]);
				} else {
					array_push($edges["E"][$reg[1]+1],$reg[0]);
				}
		}
		
		if(isset($grid[$reg[0]][$reg[1]-1])){
			if($grid[$reg[0]][$reg[1]-1] != $symbol){
				if(!isset($edges["W"][$reg[1]-1])){
					$edges["W"][$reg[1]-1] = array($reg[0]);
				} else {
					array_push($edges["W"][$reg[1]-1],$reg[0]);
				}
			}
		} else {
			if(!isset($edges["W"][$reg[1]-1])){
					$edges["W"][$reg[1]-1] = array($reg[0]);
				} else {
					array_push($edges["W"][$reg[1]-1],$reg[0]);
				}
		}			
	}
	//var_dump($edges);
	return $edges;
}

function getSidesCount($edges){
	$sides = 0;
	foreach($edges as $key => $val){
		foreach($edges[$key] as $edg){
			sort($edg);
			for($i = 0;$i < count($edg)-1;$i++){
				if((abs($edg[$i]-$edg[$i+1])) > 1){
					$sides += 1;
				}
			}
			$sides += 1;
		}
	}
	return $sides;
}


function part1($grid){
	$regions = array();
	$taken = array();
	$counter = 0;
	$vsota = 0;
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if(!isset($taken[$i][$j])){
				$symbol = $grid[$i][$j];
				$id = $symbol.":".$counter;
				$regions[$id] = array();
				getRegions($regions,$i,$j,$taken,$grid,$id,$symbol);
				$counter += 1;
			}
		}
	}
	foreach($regions as $key => $region){
		$neki = explode(":",$key);
		$regionCount = getRegionCount($region,$grid,$neki[0]);
		$vsota += count($region) * $regionCount;
	}
	return $vsota;
}

function part2($grid){
	$regions = array();
	$taken = array();
	$counter = 0;
	$vsota = 0;
	for($i = 0;$i < count($grid);$i++){
		for($j = 0;$j < count($grid[$i]);$j++){
			if(!isset($taken[$i][$j])){
				$symbol = $grid[$i][$j];
				$id = $symbol.":".$counter;
				$regions[$id] = array();
				getRegions($regions,$i,$j,$taken,$grid,$id,$symbol);
				$counter += 1;
			}
		}
	}
	foreach($regions as $key => $region){
		$neki = explode(":",$key);
		$edges = getEdges($region,$grid,$neki[0]);
		
		$sides = getSidesCount($edges);

		$totalCount = count($region) * $sides;
		$vsota += $totalCount;
	}
	return $vsota;			
}


$grid = init('day12_input.txt');

$dict = array();

$start = microtime(true);
echo "The checksum is: ".part1($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";

$start = microtime(true);
echo "The checksum is: ".part2($grid)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";


?>