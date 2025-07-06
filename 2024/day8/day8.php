<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$grid = array();
	foreach($lines as $line) {
		$line = trim($line);
		$line = str_split($line);
		array_push($grid,$line);
	}

	return $grid;	
}

function part1($grid,&$antenas){
	$antenas = array();
	$antinodes = array();
	$maxY = count($grid);
	$maxX = count($grid[0]);
	// getting antenas positions
	for($i = 0;$i < $maxY;$i++){
		for($j = 0;$j < $maxX;$j++){
			if($grid[$i][$j] != "."){
				if(isset($antenas[$grid[$i][$j]])){
					array_push($antenas[$grid[$i][$j]],array($j,$i));
				} else {
					$antenas[$grid[$i][$j]] = array(array($j,$i));
				}
			}
		}
	}
	// getting antinodes positions 
	foreach($antenas as $key => $ant){
		for($i = 0;$i < count($ant);$i++){
			$x1 = $ant[$i][0];
			$y1 = $ant[$i][1];
			for($j = $i+1; $j < count($ant);$j++){
				$x2 = $ant[$j][0];
				$y2 = $ant[$j][1];
				$difx = $x1 - $x2;
				$dify = $y1 - $y2;
				$antix1 = $x1 + $difx;
				$antiy1 = $y1 + $dify;
				$antix2 = $x2 - $difx;
				$antiy2 = $y2 - $dify;
				if($antix1 >= 0 && $antix1 < $maxX && $antiy1 >= 0 && $antiy1 < $maxY){
					$antinodes[$antix1.":".$antiy1] = 1;
				}
				if($antix2 >= 0 && $antix2 < $maxX && $antiy2 >= 0 && $antiy2 < $maxY){
					$antinodes[$antix2.":".$antiy2] = 1;
				}
			}
		}
	}
	echo "Unique antinode positions are: ".count($antinodes)."\n";
}



function part2($grid,$antenas){
	$antinodes = array();
	$maxY = count($grid);
	$maxX = count($grid[0]);
	// getting antinodes positions
	foreach($antenas as $key => $ant){
		for($i = 0;$i < count($ant);$i++){
			$x1 = $ant[$i][0];
			$y1 = $ant[$i][1];
			if(!isset($antinodes[$x1.":".$y1])){
				$antinodes[$x1.":".$y1] = 1;
			}
			for($j = $i+1; $j < count($ant);$j++){
				$x2 = $ant[$j][0];
				$y2 = $ant[$j][1];
				if(!isset($antinodes[$x2.":".$y2])){
					$antinodes[$x2.":".$y2] = 1;
				}
				$difx = $x1 - $x2;
				$dify = $y1 - $y2;
				$antix1 = $x1 + $difx;
				$antiy1 = $y1 + $dify;
				$antix2 = $x2 - $difx;
				$antiy2 = $y2 - $dify;
				if($antix1 >= 0 && $antix1 < $maxX && $antiy1 >= 0 && $antiy1 < $maxY){
					$antinodes[$antix1.":".$antiy1] = 1;
				}
				if($antix2 >= 0 && $antix2 < $maxX && $antiy2 >= 0 && $antiy2 < $maxY){
					$antinodes[$antix2.":".$antiy2] = 1;
				}
				// getting antinode positions that are on the grid for a set of points
				while(($antix1 >= 0 && $antix1 < $maxX && $antiy1 >= 0 && $antiy1 < $maxY) || ($antix2 >= 0 && $antix2 < $maxX && $antiy2 >= 0 && $antiy2 < $maxY)){
					$antix1 = $antix1 + $difx;
					$antiy1 = $antiy1 + $dify;
					$antix2 = $antix2 - $difx;
					$antiy2 = $antiy2 - $dify;
					if($antix1 >= 0 && $antix1 < $maxX && $antiy1 >= 0 && $antiy1 < $maxY){
						$antinodes[$antix1.":".$antiy1] = 1;
					}
					if($antix2 >= 0 && $antix2 < $maxX && $antiy2 >= 0 && $antiy2 < $maxY){
						$antinodes[$antix2.":".$antiy2] = 1;
					}					
				}
			}
		}
	}
	echo "Unique antinode positions are: ".count($antinodes)."\n";
}


$antenas = array();
$start = microtime(true);
$grid = init('day8_input.txt');
part1($grid,$antenas);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
$start = microtime(true);
part2($grid,$antenas);
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>