<?php

// function for initialization and construction of the grid from input file
function init($file){
	$lines = file($file);
	$machines = array();
	$counter = 0;
	$temp = array();
	foreach($lines as $line) {
		$line = trim($line);
		if($counter == 0){
			$temp["A"] = $line;
		} else if($counter == 1){
			$temp["B"] = $line;
		} else if($counter == 2){
			$temp["P"] = $line;
		}
		if($counter == 3){
			array_push($machines,$temp);
			$temp = array();
			$counter = -1;
		}
		$counter += 1;
	}
	array_push($machines,$temp);
	for($i = 0;$i < count($machines);$i++){
		// button A
		$temp_str = explode(", ",$machines[$i]["A"]);
		$temp_str[0] = intval(explode("+",explode(" ",$temp_str[0])[2])[1]);
		$temp_str[1] = intval(explode("+",$temp_str[1])[1]);
		$machines[$i]["A"] = array($temp_str[0],$temp_str[1]);
		// button B
		$temp_str = explode(", ",$machines[$i]["B"]);
		$temp_str[0] = intval(explode("+",explode(" ",$temp_str[0])[2])[1]);
		$temp_str[1] = intval(explode("+",$temp_str[1])[1]);
		$machines[$i]["B"] = array($temp_str[0],$temp_str[1]);
		// Prizes
		$temp_str = explode(", ",$machines[$i]["P"]);
		$temp_str[0] = intval(explode("=",explode(" ",$temp_str[0])[1])[1]);
		$temp_str[1] = intval(explode("=",$temp_str[1])[1]);
		$machines[$i]["P"] = array($temp_str[0],$temp_str[1]);
	}

	return $machines;	
}

function update(&$machines){
	for($i = 0;$i < count($machines);$i++){
		$machines[$i]["P"][0] = 10000000000000 + $machines[$i]["P"][0];
		$machines[$i]["P"][1] = 10000000000000 + $machines[$i]["P"][1];
	}	
}

function solveMachine($Ax,$Ay,$Bx,$By,$Px,$Py){
	$det = $Ax * $By - $Ay * $Bx;
	if($det == 0){
		return 0;
	}
	$Anum = $Px * $By - $Py * $Bx;
	$Bnum = $Ax * $Py - $Ay * $Px;
	if(($Anum % $det == 0) && ($Bnum % $det == 0)){
		$a = $Anum / $det;
		$b = $Bnum / $det;
		if($a < 0){
			$a = 0;
		} 
		if($b < 0){
			$b = 0;
		}
		return 3 * $a + $b;
	}
	return 0;
}

function part1($machines){
	$vsota = 0;
	foreach($machines as $machine){
		$cost = solveMachine($machine["A"][0],$machine["A"][1],$machine["B"][0],$machine["B"][1],$machine["P"][0],$machine["P"][1]);
		$vsota += $cost;
	}
	return $vsota;
}

function part2($machines){
	$vsota = 0;
	foreach($machines as $machine){
		$cost = solveMachine($machine["A"][0],$machine["A"][1],$machine["B"][0],$machine["B"][1],$machine["P"][0],$machine["P"][1]);
		$vsota += $cost;
	}
	return $vsota;			
}

$machines = init('day13_input.txt');
$start = microtime(true);
echo "The checksum is: ".part1($machines)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
update($machines);

$start = microtime(true);
echo "The checksum is: ".part2($machines)."\n";
echo ($time_elapsed_secs = microtime(true) - $start)."\n";
?>