<?php

function init($file,&$ranges,&$ids) {
    $lines = file($file);
	$grid = array();
	$p1 = true;
    foreach ($lines as $line) {
        $line = trim($line);
		if($line == ""){
			$p1 = false;
			continue;
		}
		if($p1){
			$delcki = array_map("intval",explode("-",$line));
			array_push($ranges,$delcki);
		} else {
			array_push($ids,intval($line));
		}
    }
}

function part1($ranges,$ids){
	$vsota = 0;
	// for each id we checks if it is in any of the ranges if it is we increment the sum and return it
	foreach($ids as $id){
		foreach($ranges as $range){
			if($id >= $range[0] && $id <= $range[1]){
				$vsota += 1;
				break;
			}
		}
	}
	return $vsota;
}

// merges two intervals into a larger one
// $ranges, update node, delete node, direction L => left, R => right
function mergeIntervals(&$ranges,$i,$j,$dir){
	// if the direction is Left we update the start of an interval, if it is Right we update the end of the interval
	// at the end we remove the interval that has been merged
	if($dir == "L"){
		$ranges[$i][0] = $ranges[$j][0];
	} else if($dir == "R"){
		$ranges[$i][1] = $ranges[$j][1];
	}
	removeIntervals($ranges,$j);
}

// removes the wholey contained interval
function removeIntervals(&$ranges,$index){
	$dolzina = count($ranges);
	$newRanges = array();
	// we create the new list of ranges and copy the existing ranges except the selected range that we want to delete
	// at the end we update the ranges
	for($i = 0;$i < $dolzina;$i++){
		if($i == $index){
			continue;
		}
		array_push($newRanges,$ranges[$i]);
	}
	$ranges = $newRanges;
	
}

function updateRanges(&$ranges){
	// we compare each range with one another
	for($i = 0;$i < count($ranges);$i++){
		for($j = $i + 1;$j < count($ranges);$j++){
			// we save the start and end interval values for easier translation
			$prviBegin = $ranges[$i][0];
			$prviEnd = $ranges[$i][1];
			$drugiBegin = $ranges[$j][0];
			$drugiEnd = $ranges[$j][1];
			// check for removing the first interval
			if($prviBegin >= $drugiBegin && $prviEnd <= $drugiEnd){
				removeIntervals($ranges,$i);
				return true;
			// check for removing the second interval
			} else if($drugiBegin >= $prviBegin && $drugiEnd <= $prviEnd){
				removeIntervals($ranges,$j);
				return true;
			// check for merging begining of the second interval into the first and removing the second interval
			} else if($prviBegin > $drugiBegin && $prviBegin <= $drugiEnd && $prviEnd > $drugiEnd){
				mergeIntervals($ranges,$i,$j,"L");
				return true;
			// check for merging the begining of the first interval into the second and removing the first interval
			} else if($drugiBegin > $prviBegin && $drugiBegin <= $prviEnd && $drugiEnd > $prviEnd){
				mergeIntervals($ranges,$j,$i,"L");
				return true;
			// check for merging the end of the second interval into the first and removing the second interval
			} else if($prviBegin < $drugiBegin && $prviEnd <= $drugiEnd && $drugiBegin < $prviEnd){
				mergeIntervals($ranges,$i,$j,"R");
				return true;
			// check for merging the end of the first interval into the second and removing the first interval
			} else if($drugiBegin < $prviBegin && $drugiEnd <= $prviEnd && $prviBegin < $drugiEnd){
				mergeIntervals($ranges,$j,$i,"R");
				return true;
			}
		} 
		
	}
	// at the end if no merging or removing occured we return false
	return false;
}

function part2($ranges){
	$vsota = 0;
	// we first loop until no more ranges can be merged
	while(updateRanges($ranges)){
		
	}
	// we go through all the ranges and we increment the sum with the range of te range + 1
	// andd the end we return the sum
	foreach($ranges as $range){
		$vsota += ($range[1] - $range[0]) + 1;
		//echo "Range: ".$range[0]."-".$range[1]."\n";
	}
	return $vsota;
}




$ranges = array();
$ids = array();
init('day5_input.txt',$ranges,$ids);



$srt = microtime(true);
echo "The checksum for part1 is: ".part1($ranges,$ids)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($ranges)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>