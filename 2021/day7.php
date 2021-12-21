<?php
// not optimal solution
function part1($crabs){
	$min = $crabs[0];
	$max = $crabs[0];
	$vsote = array();
	find_minMax($crabs,$max,$min);
	echo "Max: ".$max." Min: ".$min."\n";
	for($i = $min;$i <= $max;$i++){
		$vsota = 0;
		foreach($crabs as $crab){
			$vsota += abs($crab - $i);
		}
		array_push($vsote,$vsota);
	}
	return min($vsote);
}

// very space efficient solution
function part2($crabs){
	$min = $crabs[0];
	$max = $crabs[0];
	$vsote = array();
	find_minMax($crabs,$max,$min);
	echo "Max: ".$max." Min: ".$min."\n";
	for($i = $min;$i <= $max;$i++){
		$vsota = 0;
		foreach($crabs as $crab){
			$delna = abs($crab - $i);
			$vsota += ($delna * ($delna + 1) / 2);
		}
		array_push($vsote,$vsota);
	}
	return min($vsote);
	
}


function find_minMax($crabs,&$max,&$min){
	foreach($crabs as $crab){
		if($crab < $min){
			$min = $crab;
		}
		if($crab > $max){
			$max = $crab;
		}
	}
}

$crabs = array_map('intval',explode(",",file_get_contents("input_day7.txt")));

echo "Part 1 resitev je: ".part1($crabs)."\n";
echo "Part 2 resitev je: ".part2($crabs)."\n";

?>