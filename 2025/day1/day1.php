<?php

function init($file) {
    $lines = file($file);
	$instructions = array();
    foreach ($lines as $line) {
        $line = trim($line);
		$inst = array();
		$inst['dir'] = $line[0];
		$inst['amount'] = intval(substr($line, 1));
		array_push($instructions,$inst);
    }
	return $instructions;
}




function make_move($dir,$amount,$pos){
	if($dir == "L"){
		return move_left($amount,$pos);
	} else {
		return move_right($amount,$pos);
	}
}



function move_right($amount,$pos){
	return ($pos + $amount) % 100; 
}

function move_left($amount,$pos){
	$part_sum = $pos - $amount;
	if($part_sum < 0){
		$part_sum += 100;
	}
	return $part_sum;
}


function make_move_part2($dir,$amount,$pos,&$vsota){
	if($dir == "L"){
		return move_left_part2($amount,$pos,$vsota);
	} else {
		return move_right_part2($amount,$pos,$vsota);
	}
}



function move_right_part2($amount,$pos,&$vsota){
	if(($pos + $amount) > 100){
		$vsota += 1;
	}
	return ($pos + $amount) % 100; 
}

function move_left_part2($amount,$pos,&$vsota){
	$part_sum = $pos - $amount;
	if($part_sum < 0){
		if($pos != 0){
			$vsota += 1;
		}
		$part_sum += 100;
	}
	return $part_sum;
}


function part1($instructions,$pos) {
	$vsota = 0;
	foreach($instructions as $i){
		$normal_amount = $i['amount'] % 100;
		$pos = make_move($i['dir'],$normal_amount,$pos);
		if($pos == 0){
			$vsota += 1;
		}
	}
	return $vsota;

}

function part2($instructions,$pos){
	$vsota = 0;
	foreach($instructions as $i){
		$vsota += intdiv($i['amount'],100);
		$normal_amount = $i['amount'] % 100;
		$pos = make_move_part2($i['dir'],$normal_amount,$pos,$vsota);
		if($pos == 0){
			$vsota += 1;
		}
	}
	return $vsota;
}








$instructions = init('day1_input.txt');

$start_pos = 50;


$srt = microtime(true);
echo "The checksum is: ".part1($instructions,$start_pos)."\n";
echo (microtime(true) - $srt)." seconds\n";


$srt = microtime(true);
echo "The checksum is: ".part2($instructions,$start_pos)."\n";
echo (microtime(true) - $srt)." seconds\n";

?>