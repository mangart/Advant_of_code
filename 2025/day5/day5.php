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

function part2($ranges,$ids){
	$vsota = 0;

	return $vsota;
}

$ranges = array();
$ids = array();
init('day5_input.txt',$ranges,$ids);



$srt = microtime(true);
echo "The checksum for part1 is: ".part1($ranges,$ids)."\n";
echo (microtime(true) - $srt)." seconds\n";

$srt = microtime(true);
echo "The checksum for part2 is: ".part2($ranges,$ids)."\n";
echo (microtime(true) - $srt)." seconds\n";
?>